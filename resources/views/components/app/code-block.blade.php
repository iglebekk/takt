@props([
    'label' => null,
])

<div {{ $attributes->class('overflow-hidden rounded-[1.5rem] border border-[var(--color-line)] bg-[var(--color-code-bg)] text-[var(--color-code-fg)] shadow-[0_12px_32px_rgba(28,34,27,0.08)]') }}>
    @if ($label)
        <div class="flex items-center justify-between border-b border-white/10 px-4 py-3 text-xs font-semibold uppercase tracking-[0.24em] text-[var(--color-code-muted)]">
            <span>{{ $label }}</span>
            <span class="inline-flex items-center gap-1.5">
                <span class="size-2 rounded-full bg-[var(--color-accent-soft)]"></span>
                <span class="size-2 rounded-full bg-[var(--color-amber)]"></span>
            </span>
        </div>
    @endif

    <pre class="overflow-x-auto px-4 py-4 text-sm leading-6"><code>{{ $slot }}</code></pre>
</div>
