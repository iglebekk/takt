<div class="bg-surface">
    <div class="mx-auto max-w-3xl px-4 py-14 sm:px-6 lg:px-8">
        <p class="text-sm font-semibold uppercase text-accent">{{ __('public.privacy.eyebrow') }}</p>
        <h1 class="mt-5 text-4xl font-semibold tracking-normal text-ink sm:text-5xl">
            {{ __('public.privacy.title') }}
        </h1>
        <p class="mt-5 text-lg leading-8 text-muted">{{ __('public.privacy.description') }}</p>

        <div class="mt-12 space-y-10">
            @foreach (__('public.privacy.sections') as $section)
                <section>
                    <h2 class="text-2xl font-semibold text-ink">{{ $section['title'] }}</h2>
                    <p class="mt-4 text-base leading-7 text-muted">{{ $section['body'] }}</p>
                </section>
            @endforeach
        </div>
    </div>
</div>
