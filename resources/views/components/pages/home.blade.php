@props([
    'generatorUrl',
])

<div class="space-y-6">
    <x-marketing.hero :generator-url="$generatorUrl" />

    <x-app.section
        :title="__('public.home.what_title')"
        :description="__('public.home.what_intro')"
    >
        <div class="grid gap-4 lg:grid-cols-3">
            @foreach (__('public.home.capabilities') as $capability)
                <x-app.card class="space-y-4">
                    <x-app.badge>{{ $capability['title'] }}</x-app.badge>
                    <p class="text-sm leading-6 text-[var(--color-muted)]">{{ $capability['body'] }}</p>
                </x-app.card>
            @endforeach
        </div>
    </x-app.section>

    <x-marketing.workflow />

    <x-marketing.use-cases />

    <x-app.section
        :title="__('public.home.channels_title')"
        :description="__('public.home.channels_intro')"
    >
        <div class="grid gap-4 xl:grid-cols-3">
            @foreach (__('public.home.channels') as $channel)
                <x-app.card class="space-y-4">
                    <div class="space-y-2">
                        <x-app.badge tone="accent">{{ $channel['label'] }}</x-app.badge>
                        <h3 class="text-xl font-semibold tracking-tight">{{ $channel['title'] }}</h3>
                        <p class="text-sm leading-6 text-[var(--color-muted)]">{{ $channel['body'] }}</p>
                    </div>

                    <x-app.code-block :label="$channel['label']">
                        {{ $channel['example'] }}
                    </x-app.code-block>
                </x-app.card>
            @endforeach
        </div>
    </x-app.section>

    <x-app.section :title="__('public.home.trust_title')">
        <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-4">
            @foreach (__('public.home.trust_points') as $point)
                <x-app.card class="flex items-center justify-between gap-4 p-5">
                    <p class="text-sm font-medium uppercase tracking-[0.18em] text-[var(--color-muted)]">{{ $point }}</p>
                    <span class="text-[var(--color-accent)]">+</span>
                </x-app.card>
            @endforeach
        </div>
    </x-app.section>

    <x-app.card tone="accent" class="space-y-5 px-6 py-8 sm:px-8">
        <div class="space-y-3">
            <x-app.badge>{{ __('public.home.final_title') }}</x-app.badge>
            <p class="max-w-3xl text-lg leading-8 text-[var(--color-ink)]">{{ __('public.home.final_body') }}</p>
        </div>

        <div class="flex flex-wrap gap-3">
            <x-app.button :href="$generatorUrl">
                {{ __('public.home.final_primary') }}
            </x-app.button>

            <x-app.button :href="route('docs')" variant="secondary">
                {{ __('public.home.final_secondary') }}
            </x-app.button>
        </div>
    </x-app.card>
</div>
