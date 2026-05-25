@props([
    'id' => null,
    'title',
    'intro' => null,
])

<section @if ($id) id="{{ $id }}" @endif {{ $attributes->class('scroll-mt-24') }}>
    <div class="max-w-3xl">
        <h2 class="text-2xl font-semibold tracking-normal text-ink sm:text-3xl">{{ $title }}</h2>

        @if ($intro)
            <p class="mt-4 text-base leading-7 text-muted">{{ $intro }}</p>
        @endif
    </div>

    <div class="mt-8">
        {{ $slot }}
    </div>
</section>
