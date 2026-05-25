@props([
    'repositoryUrl',
])

<div class="space-y-8">
    <x-app.section
        :eyebrow="__('public.about.eyebrow')"
        :title="__('public.about.title')"
        :description="__('public.about.description')"
    />

    <div class="grid gap-4 xl:grid-cols-[minmax(0,1.2fr)_minmax(0,0.8fr)]">
        <x-app.card class="space-y-8">
            <div class="space-y-3">
                <x-app.badge>{{ __('public.about.who_title') }}</x-app.badge>
                <p class="text-base leading-7 text-[var(--color-muted)]">{{ __('public.about.who_body') }}</p>
            </div>

            <div class="space-y-3">
                <x-app.badge>{{ __('public.about.why_title') }}</x-app.badge>
                <p class="text-base leading-7 text-[var(--color-muted)]">{{ __('public.about.why_body') }}</p>
            </div>
        </x-app.card>

        <x-app.card tone="accent" class="space-y-4">
            <x-app.badge>{{ __('public.about.build_title') }}</x-app.badge>
            <div class="space-y-3">
                @foreach (__('public.about.build_points') as $point)
                    <div class="flex items-center justify-between gap-4 border-b border-[color:rgba(31,122,107,0.14)] pb-3 last:border-b-0 last:pb-0">
                        <p class="text-sm font-medium uppercase tracking-[0.18em] text-[var(--color-muted)]">{{ $point }}</p>
                        <span class="text-[var(--color-accent)]">+</span>
                    </div>
                @endforeach
            </div>
        </x-app.card>
    </div>

    <x-app.section
        id="contribute"
        :title="__('public.about.contribute_title')"
        :description="__('public.about.contribute_intro')"
    >
        <div class="grid gap-4 xl:grid-cols-3">
            @foreach (__('public.about.contribute_paths') as $path)
                <x-app.card class="space-y-3">
                    <h3 class="text-xl font-semibold tracking-tight">{{ $path['title'] }}</h3>
                    <p class="text-sm leading-6 text-[var(--color-muted)]">{{ $path['body'] }}</p>
                </x-app.card>
            @endforeach
        </div>
    </x-app.section>

    <x-app.card class="space-y-4">
        <x-app.badge tone="accent">{{ __('public.about.links_title') }}</x-app.badge>
        <p class="max-w-3xl text-sm leading-6 text-[var(--color-muted)]">{{ __('public.about.links_body') }}</p>
        <div class="flex flex-wrap gap-3">
            <x-app.button :href="$repositoryUrl" variant="secondary">
                {{ __('public.nav.github') }}
            </x-app.button>

            <x-app.button :href="$repositoryUrl" variant="ghost">
                {{ __('public.nav.contribute') }}
            </x-app.button>
        </div>
    </x-app.card>
</div>
