<div class="space-y-10">
    <x-app.section
        :eyebrow="__('public.docs.eyebrow')"
        :title="__('public.docs.title')"
        :description="__('public.docs.description')"
    >
        <div class="flex flex-wrap gap-3">
            <x-app.button href="#url" variant="secondary">{{ __('public.docs.jump_title') }}: URL</x-app.button>
            <x-app.button href="#api" variant="secondary">API</x-app.button>
            <x-app.button href="#mcp" variant="secondary">MCP</x-app.button>
        </div>
    </x-app.section>

    <div class="grid gap-8 lg:grid-cols-[15rem_minmax(0,1fr)]">
        <aside class="lg:sticky lg:top-28 lg:self-start">
            <x-app.card class="space-y-4 p-5">
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--color-muted)]">{{ __('public.docs.jump_title') }}</p>
                <div class="space-y-3 text-sm font-medium">
                    <a href="#url" class="block transition hover:text-[var(--color-accent)]">URL</a>
                    <a href="#api" class="block transition hover:text-[var(--color-accent)]">API</a>
                    <a href="#mcp" class="block transition hover:text-[var(--color-accent)]">MCP</a>
                    <a href="#notes" class="block transition hover:text-[var(--color-accent)]">{{ __('public.docs.notes_title') }}</a>
                </div>
            </x-app.card>
        </aside>

        <div class="space-y-10">
            <x-app.section
                :title="__('public.docs.overview_title')"
                :description="__('public.docs.overview_intro')"
            >
                <div class="grid gap-4 xl:grid-cols-3">
                    @foreach (__('public.docs.overview') as $item)
                        <x-app.card class="space-y-3">
                            <x-app.badge tone="accent">{{ $item['label'] }}</x-app.badge>
                            <h3 class="text-xl font-semibold tracking-tight">{{ $item['title'] }}</h3>
                            <p class="text-sm leading-6 text-[var(--color-muted)]">{{ $item['body'] }}</p>
                        </x-app.card>
                    @endforeach
                </div>
            </x-app.section>

            <x-docs.endpoint
                id="url"
                label="URL"
                :title="__('public.docs.url_title')"
                :body="__('public.docs.url_body')"
                :best-for="__('public.docs.url_best_for')"
                :result="__('public.docs.url_result')"
                example-label="GET /create"
                example="/create?title=Demo%20Day&start=2026-06-03T12:00:00%2B02:00&end=2026-06-03T15:00:00%2B02:00&location=Kristiansand&alarm_minutes=30"
            />

            <x-docs.endpoint
                id="api"
                label="API"
                :title="__('public.docs.api_title')"
                :body="__('public.docs.api_body')"
                :best-for="__('public.docs.api_best_for')"
                :result="__('public.docs.api_result')"
                example-label="POST /api/ics"
                :example="trim(<<<'JSON'
{
  \"title\": \"Demo Day\",
  \"description\": \"Pitches and networking\",
  \"location\": \"Kristiansand\",
  \"start\": \"2026-06-03T12:00:00+02:00\",
  \"end\": \"2026-06-03T15:00:00+02:00\",
  \"timezone\": \"Europe/Oslo\",
  \"alarm_minutes\": 30,
  \"url\": \"https://example.com/event\"
}
JSON)"
            />

            <x-docs.endpoint
                id="mcp"
                label="MCP"
                :title="__('public.docs.mcp_title')"
                :body="__('public.docs.mcp_body')"
                :best-for="__('public.docs.mcp_best_for')"
                :result="__('public.docs.mcp_result')"
                example-label="Tool call"
                :example="trim(<<<'JSON'
{
  \"tool\": \"generate_ical_file\",
  \"input\": {
    \"title\": \"Board meeting\",
    \"start\": \"2026-06-12T14:00:00+02:00\",
    \"end\": \"2026-06-12T16:00:00+02:00\",
    \"timezone\": \"Europe/Oslo\"
  }
}
JSON)"
            />

            <x-app.section id="notes" :title="__('public.docs.supported_fields_title')">
                <div class="grid gap-4 xl:grid-cols-[minmax(0,1fr)_minmax(0,1fr)]">
                    <x-app.card class="space-y-3">
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--color-muted)]">{{ __('public.docs.supported_fields_title') }}</p>
                        <div class="space-y-3">
                            @foreach (__('public.docs.supported_fields') as $field)
                                <p class="text-sm leading-6 text-[var(--color-muted)]">{{ $field }}</p>
                            @endforeach
                        </div>
                    </x-app.card>

                    <x-app.card class="space-y-3">
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--color-muted)]">{{ __('public.docs.notes_title') }}</p>
                        <div class="space-y-3">
                            @foreach (__('public.docs.notes') as $note)
                                <p class="text-sm leading-6 text-[var(--color-muted)]">{{ $note }}</p>
                            @endforeach
                        </div>
                    </x-app.card>
                </div>
            </x-app.section>

            <x-app.card tone="accent" class="space-y-3 p-6">
                <x-app.badge>{{ __('public.docs.support_title') }}</x-app.badge>
                <p class="max-w-3xl text-sm leading-6 text-[var(--color-ink)]">{{ __('public.docs.support_body') }}</p>
            </x-app.card>
        </div>
    </div>
</div>
