@props([
    'eyebrow' => null,
    'title' => null,
    'description' => null,
    'contentClass' => '',
])

<section {{ $attributes->class('space-y-8 py-8 sm:py-12') }}>
    @if ($eyebrow || $title || $description)
        <div class="max-w-3xl space-y-4">
            @if ($eyebrow)
                <x-app.badge>{{ $eyebrow }}</x-app.badge>
            @endif

            @if ($title)
                <h2 class="max-w-3xl text-3xl font-semibold tracking-tight sm:text-4xl">{{ $title }}</h2>
            @endif

            @if ($description)
                <p class="text-base leading-7 text-[var(--color-muted)] sm:text-lg">{{ $description }}</p>
            @endif
        </div>
    @endif

    <div @class([$contentClass])>
        {{ $slot }}
    </div>
</section>
