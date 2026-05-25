<footer class="border-t border-line bg-surface">
    <div class="mx-auto flex max-w-7xl flex-col gap-4 px-4 py-8 text-sm text-muted sm:px-6 md:flex-row md:items-center md:justify-between lg:px-8">
        <p>{{ __('public.footer.tagline') }}</p>

        <nav class="flex flex-wrap gap-4" aria-label="{{ __('public.footer.navigation') }}">
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
    </div>
</footer>
