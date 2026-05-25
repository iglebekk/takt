@props([
    'items',
])

<nav {{ $attributes->class('grid gap-1 text-sm') }} aria-label="{{ __('public.docs.navigation_label') }}">
    @foreach ($items as $id => $label)
        <x-app.link href="#{{ $id }}" class="border-l border-line px-3 py-2 text-muted hover:border-accent hover:text-accent">
            {{ $label }}
        </x-app.link>
    @endforeach
</nav>
