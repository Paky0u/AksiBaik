@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-[#0ecedb] text-start text-base font-medium text-[#0ecedb] bg-blue-50 focus:outline-none focus:text-[#117554] focus:bg-blue-100 focus:border-[#117554] transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-[#0ecedb] hover:bg-gray-50 hover:border-[#6ef3d6] focus:outline-none focus:text-[#0ecedb] focus:bg-gray-50 focus:border-[#0ecedb] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
