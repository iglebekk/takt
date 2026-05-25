<header class="sticky top-0 z-30 border-b border-line bg-surface/95 backdrop-blur">
    <div class="mx-auto flex h-14 max-w-7xl items-center justify-between gap-6 px-4 sm:px-6 lg:px-8">
        <x-app.link href="{{ route('home') }}" class="text-base font-semibold text-ink">
            {{ __('public.brand') }}
        </x-app.link>

        <nav class="hidden items-center gap-6 text-sm md:flex" aria-label="{{ __('public.nav.primary') }}">
            <x-app.link href="{{ route('home') }}#calendar-form">
                {{ __('public.nav.create') }}
            </x-app.link>
            <x-app.link href="{{ route('docs') }}">
                {{ __('public.nav.docs') }}
            </x-app.link>
            <x-app.link href="{{ route('privacy') }}">
                {{ __('public.nav.privacy') }}
            </x-app.link>
            <x-app.link href="{{ __('public.repository_url') }}">
                {{ __('public.nav.github') }}
            </x-app.link>
        </nav>

        <details class="relative md:hidden">
            <summary class="list-none">
                <x-app.button as="div" variant="ghost" size="sm">
                    {{ __('public.nav.menu') }}
                </x-app.button>
            </summary>
            <nav class="absolute right-0 mt-3 grid w-56 gap-1 border border-line bg-surface p-3 text-sm shadow-xs" aria-label="{{ __('public.nav.mobile') }}">
                <x-app.link href="{{ route('home') }}#calendar-form" class="px-2 py-2">
                    {{ __('public.nav.create') }}
                </x-app.link>
                <x-app.link href="{{ route('docs') }}" class="px-2 py-2">
                    {{ __('public.nav.docs') }}
                </x-app.link>
                <x-app.link href="{{ route('privacy') }}" class="px-2 py-2">
                    {{ __('public.nav.privacy') }}
                </x-app.link>
                <x-app.link href="{{ __('public.repository_url') }}" class="px-2 py-2">
                    {{ __('public.nav.github') }}
                </x-app.link>
            </nav>
        </details>
    </div>
</header>
