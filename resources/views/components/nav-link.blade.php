@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-[#4379F2] text-sm font-medium leading-5 text-[#4379F2] focus:outline-none focus:border-[#117554] transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-[#4379F2] hover:border-[#6EC207] focus:outline-none focus:text-[#4379F2] focus:border-[#4379F2] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
