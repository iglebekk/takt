@props([
    'tone' => 'default',
])

@php
    $toneClasses = match ($tone) {
        'accent' => 'border-[color:rgba(31,122,107,0.24)] bg-[color:rgba(31,122,107,0.1)] text-[var(--color-accent)]',
        default => 'border-[var(--color-line)] bg-[color:rgba(255,255,255,0.65)] text-[var(--color-muted)]',
    };
@endphp

<span {{ $attributes->class("inline-flex items-center rounded-full border px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.24em] {$toneClasses}") }}>
    {{ $slot }}
</span>
