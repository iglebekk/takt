@props([
    'title',
    'ctaUrl',
    'repositoryUrl',
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title }}</title>

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="min-h-screen bg-[var(--color-paper)] text-[var(--color-ink)] antialiased">
        <div class="absolute inset-x-0 top-0 -z-10 h-[34rem] bg-[radial-gradient(circle_at_top_left,_rgba(31,122,107,0.16),_transparent_45%),radial-gradient(circle_at_top_right,_rgba(201,139,46,0.12),_transparent_38%)]"></div>
        <div class="absolute inset-0 -z-20 bg-[linear-gradient(rgba(28,34,27,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(28,34,27,0.04)_1px,transparent_1px)] bg-[size:2.75rem_2.75rem] [mask-image:linear-gradient(to_bottom,rgba(0,0,0,0.22),transparent_70%)]"></div>

        <div class="mx-auto flex min-h-screen max-w-7xl flex-col px-4 sm:px-6 lg:px-8">
            <header class="sticky top-0 z-20 py-4">
                <div class="flex items-center justify-between rounded-full border border-[var(--color-line)] bg-[color:rgba(255,253,248,0.86)] px-5 py-3 shadow-sm backdrop-blur">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-3 text-sm font-semibold tracking-[0.22em] uppercase">
                        <span class="inline-flex size-8 items-center justify-center rounded-full border border-[var(--color-line-strong)] bg-[var(--color-surface)] text-[var(--color-accent)]">T</span>
                        {{ __('public.brand') }}
                    </a>

                    <nav class="hidden items-center gap-6 text-sm font-medium text-[var(--color-muted)] md:flex">
                        <a href="{{ route('home') }}" class="transition hover:text-[var(--color-ink)]">{{ __('public.nav.home') }}</a>
                        <a href="{{ route('docs') }}" class="transition hover:text-[var(--color-ink)]">{{ __('public.nav.docs') }}</a>
                        <a href="{{ route('about') }}" class="transition hover:text-[var(--color-ink)]">{{ __('public.nav.about') }}</a>
                    </nav>

                    <x-app.button :href="$ctaUrl" variant="primary" size="sm">
                        {{ __('public.nav.open_generator') }}
                    </x-app.button>
                </div>
            </header>

            <main class="flex-1 py-8 sm:py-12">
                {{ $slot }}
            </main>

            <footer class="border-t border-[var(--color-line)] py-8">
                <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                    <div class="space-y-2">
                        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-[var(--color-muted)]">{{ __('public.brand') }}</p>
                        <p class="max-w-xl text-sm leading-6 text-[var(--color-muted)]">{{ __('public.footer.tagline') }}</p>
                    </div>

                    <div class="space-y-3 text-sm text-[var(--color-muted)] md:text-right">
                        <div class="flex flex-wrap items-center gap-4 md:justify-end">
                            <a href="{{ route('docs') }}" class="transition hover:text-[var(--color-ink)]">{{ __('public.nav.docs') }}</a>
                            <a href="{{ route('about') }}" class="transition hover:text-[var(--color-ink)]">{{ __('public.nav.about') }}</a>
                            <a href="{{ $repositoryUrl }}" class="transition hover:text-[var(--color-ink)]">{{ __('public.nav.github') }}</a>
                        </div>
                        <p>{{ __('public.footer.copyright') }}</p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
