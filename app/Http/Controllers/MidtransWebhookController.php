<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use Illuminate\Support\Facades\Log;

class MidtransWebhookController extends Controller
{
    public function handle(Request $request)
    {
        try {
            $payload = $request->all();
            
            Log::info('Midtrans Webhook Received:', $payload);

            $orderId = $payload['order_id'] ?? null;
            $statusCode = $payload['status_code'] ?? null;
            $grossAmount = $payload['gross_amount'] ?? null;
            $signatureKey = $payload['signature_key'] ?? null;
            $transactionStatus = $payload['transaction_status'] ?? null;

            if (!$orderId || !$statusCode || !$grossAmount || !$signatureKey) {
                return response()->json(['message' => 'Invalid payload'], 400);
            }

            // Validasi Signature Key (Anti-Fraud)
            $serverKey = config('services.midtrans.server_key');
            $calculatedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

            if ($calculatedSignature !== $signatureKey) {
                Log::warning("Midtrans Webhook: Invalid signature for Order ID $orderId");
                return response()->json(['message' => 'Invalid signature'], 403);
            }

            // Cari data donasi berdasarkan order_id
            $donasi = Donasi::where('midtrans_order_id', $orderId)->first();

            if (!$donasi) {
                Log::warning("Midtrans Webhook: Order ID $orderId not found in database");
                return response()->json(['message' => 'Order not found'], 404);
            }

            // Update status berdasarkan transaction_status Midtrans
            $donasi->midtrans_status = $transactionStatus;

            if (in_array($transactionStatus, ['capture', 'settlement'])) {
                $donasi->status_donasi = 'Diterima';
            } elseif (in_array($transactionStatus, ['deny', 'cancel', 'expire'])) {
                $donasi->status_donasi = 'Ditolak';
            } elseif ($transactionStatus === 'pending') {
                $donasi->status_donasi = 'Menunggu Verifikasi';
            }

            $donasi->save();
            Log::info("Midtrans Webhook: Order ID $orderId successfully updated to $transactionStatus");

            return response()->json(['message' => 'Webhook processed successfully'], 200);

        } catch (\Exception $e) {
            Log::error('Midtrans Webhook Error: ' . $e->getMessage());
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }
}

