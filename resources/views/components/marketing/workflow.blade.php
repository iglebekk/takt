<x-app.section
    :title="__('public.home.workflow_title')"
    :description="__('public.home.workflow_intro')"
>
    <div class="grid gap-4 lg:grid-cols-3">
        @foreach (__('public.home.workflow_steps') as $step)
            <x-app.card class="space-y-4">
                <div class="flex items-center justify-between">
                    <x-app.badge tone="accent">{{ $loop->iteration }}</x-app.badge>
                    @if (! $loop->last)
                        <span class="hidden text-[var(--color-accent)] lg:inline">→</span>
                    @endif
                </div>
                <div class="space-y-2">
                    <h3 class="text-xl font-semibold tracking-tight">{{ $step['title'] }}</h3>
                    <p class="text-sm leading-6 text-[var(--color-muted)]">{{ $step['body'] }}</p>
                </div>
            </x-app.card>
        @endforeach
    </div>
</x-app.section>
