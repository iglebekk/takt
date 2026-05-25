@props([
    'generatorUrl',
])

<section class="grid gap-8 py-8 lg:grid-cols-[minmax(0,1.1fr)_minmax(22rem,0.9fr)] lg:items-center lg:py-12">
    <div class="space-y-6">
        <x-app.badge tone="accent">{{ __('public.home.eyebrow') }}</x-app.badge>

        <div class="space-y-4">
            <h1 class="max-w-4xl text-4xl font-semibold tracking-tight sm:text-5xl lg:text-6xl">{{ __('public.home.title') }}</h1>
            <p class="max-w-2xl text-lg leading-8 text-[var(--color-muted)]">{{ __('public.home.description') }}</p>
        </div>

        <div class="flex flex-wrap gap-3">
            <x-app.button :href="$generatorUrl">
                {{ __('public.home.primary_cta') }}
            </x-app.button>

            <x-app.button :href="route('docs')" variant="secondary">
                {{ __('public.home.secondary_cta') }}
            </x-app.button>
        </div>
    </div>

    <x-app.card class="space-y-5">
        <div class="space-y-3">
            <x-app.badge>{{ __('public.home.hero_card_title') }}</x-app.badge>
            <p class="text-sm leading-6 text-[var(--color-muted)]">{{ __('public.home.hero_card_body') }}</p>
        </div>

        <div class="grid gap-3 md:grid-cols-3 lg:grid-cols-1 xl:grid-cols-3">
            <x-app.card tone="accent" class="space-y-2 p-4">
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--color-accent)]">{{ __('public.home.hero_url_label') }}</p>
                <p class="text-sm leading-6">`GET /create?...`</p>
            </x-app.card>

            <x-app.card class="space-y-2 p-4">
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--color-muted)]">{{ __('public.home.hero_api_label') }}</p>
                <p class="text-sm leading-6">`POST /api/ics`</p>
            </x-app.card>

            <x-app.card class="space-y-2 p-4">
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--color-muted)]">{{ __('public.home.hero_mcp_label') }}</p>
                <p class="text-sm leading-6">`generate_ical_file`</p>
            </x-app.card>
        </div>

        <x-app.code-block :label="__('public.home.hero_preview_title')">
BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//Takt//iCalendar Generator//EN
BEGIN:VEVENT
SUMMARY:Demo Day
DTSTART:20260603T100000Z
DTEND:20260603T130000Z
END:VEVENT
END:VCALENDAR
        </x-app.code-block>

        <p class="text-sm leading-6 text-[var(--color-muted)]">{{ __('public.home.hero_preview_body') }}</p>
    </x-app.card>
</section>
