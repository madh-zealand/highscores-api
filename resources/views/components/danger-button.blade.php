@props([
    // Options: large, normal, small
    'size' => 'normal',
])
@php(
    $sizeClass = match ($size) {
        'large' => 'px-5 py-3 text-sm',
        'small' => 'px-2 py-1 text-xs',
        default => 'px-4 py-2 text-xs',
    }
)

<button {{ $attributes->merge(['type' => 'submit', 'class' => $sizeClass . ' inline-flex items-center bg-red-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
