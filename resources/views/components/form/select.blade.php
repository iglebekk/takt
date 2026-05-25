@props([
    'name',
    'label',
    'options',
    'value' => null,
    'required' => false,
    'description' => null,
])

@php
    $selected = old($name, $value);
@endphp

<flux:select
    :name="$name"
    :label="$label"
    :required="$required"
    :description="$description"
    {{ $attributes }}
>
    @foreach ($options as $optionValue => $optionLabel)
        <option value="{{ $optionValue }}" @if ((string) $selected === (string) $optionValue) selected @endif>
            {{ $optionLabel }}
        </option>
    @endforeach
</flux:select>
