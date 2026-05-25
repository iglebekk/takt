<x-app.section
    :title="__('public.home.use_cases_title')"
    :description="__('public.home.use_cases_intro')"
>
    <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-3">
        @foreach (__('public.home.use_cases') as $useCase)
            <x-app.card class="flex items-center justify-between gap-4 p-5">
                <p class="text-base font-medium">{{ $useCase }}</p>
                <span class="text-[var(--color-accent)]">→</span>
            </x-app.card>
        @endforeach
    </div>
</x-app.section>
