@props([
    'variant' => 'primary',
    'size' => 'base',
    'as' => null,
])

<flux:button
    :variant="$variant"
    :size="$size"
    :as="$as"
    {{ $attributes->class('focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent') }}
>
    {{ $slot }}
</flux:button>
