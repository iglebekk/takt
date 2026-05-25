@props([
    'href' => null,
    'variant' => 'primary',
    'size' => 'md',
])

@php
    $baseClasses = 'inline-flex items-center justify-center gap-2 rounded-full border font-medium transition focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] focus:ring-offset-2 focus:ring-offset-[var(--color-paper)]';
    $sizeClasses = match ($size) {
        'sm' => 'px-4 py-2 text-sm',
        default => 'px-5 py-3 text-sm sm:text-base',
    };
    $variantClasses = match ($variant) {
        'secondary' => 'border-[var(--color-line-strong)] bg-[var(--color-surface)] text-[var(--color-ink)] hover:bg-white',
        'ghost' => 'border-transparent bg-transparent text-[var(--color-ink)] hover:bg-[color:rgba(28,34,27,0.06)]',
        default => 'border-[var(--color-accent)] bg-[var(--color-accent)] text-white hover:bg-[var(--color-accent-strong)]',
    };
    $classes = implode(' ', [$baseClasses, $sizeClasses, $variantClasses]);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class($classes) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->class($classes) }}>
        {{ $slot }}
    </button>
@endif
