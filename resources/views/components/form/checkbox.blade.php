@props([
    'name',
    'label',
    'value' => '1',
    'checked' => false,
    'description' => null,
])

@php
    $isChecked = (bool) old($name, $checked);
@endphp

<label {{ $attributes->class('flex items-start gap-3 text-sm text-ink') }}>
    <input
        type="checkbox"
        name="{{ $name }}"
        value="{{ $value }}"
        @checked($isChecked)
        class="mt-0.5 size-4 rounded border-line text-accent focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent"
    >
    <span>
        <span class="block font-medium">{{ $label }}</span>
        @if ($description)
            <span class="mt-1 block text-muted">{{ $description }}</span>
        @endif
    </span>
</label>
