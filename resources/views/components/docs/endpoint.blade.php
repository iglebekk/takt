@props([
    'id',
    'label',
    'title',
    'body',
    'bestFor',
    'result',
    'exampleLabel',
    'example',
])

<section id="{{ $id }}" class="scroll-mt-28 space-y-5">
    <div class="space-y-3">
        <x-app.badge tone="accent">{{ $label }}</x-app.badge>
        <div class="space-y-2">
            <h3 class="text-2xl font-semibold tracking-tight">{{ $title }}</h3>
            <p class="max-w-3xl text-base leading-7 text-[var(--color-muted)]">{{ $body }}</p>
        </div>
    </div>

    <div class="grid gap-4 lg:grid-cols-[minmax(0,1fr)_20rem]">
        <x-app.code-block :label="$exampleLabel">
            {{ $example }}
        </x-app.code-block>

        <x-app.card class="space-y-4">
            <div class="space-y-1">
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--color-muted)]">{{ __('public.docs.best_for') }}</p>
                <p class="text-sm leading-6 text-[var(--color-ink)]">{{ $bestFor }}</p>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--color-muted)]">{{ __('public.docs.returns') }}</p>
                <p class="text-sm leading-6 text-[var(--color-ink)]">{{ $result }}</p>
            </div>
        </x-app.card>
    </div>
</section>
