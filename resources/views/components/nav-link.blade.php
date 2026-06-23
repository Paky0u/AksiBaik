@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-[#0ecedb] text-sm font-medium leading-5 text-[#0ecedb] focus:outline-none focus:border-[#117554] transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-[#0ecedb] hover:border-[#6ef3d6] focus:outline-none focus:text-[#0ecedb] focus:border-[#0ecedb] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
