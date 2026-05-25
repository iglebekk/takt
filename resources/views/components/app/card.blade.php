@props([
    'tone' => 'default',
])

@php
    $toneClasses = match ($tone) {
        'accent' => 'border-[color:rgba(31,122,107,0.28)] bg-[color:rgba(31,122,107,0.08)]',
        default => 'border-[var(--color-line)] bg-[color:rgba(255,253,248,0.92)]',
    };
@endphp

<div {{ $attributes->class("rounded-[1.75rem] border p-6 shadow-[0_12px_40px_rgba(28,34,27,0.06)] {$toneClasses}") }}>
    {{ $slot }}
</div>
