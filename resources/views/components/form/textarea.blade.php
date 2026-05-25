@props([
    'name',
    'label',
    'value' => null,
    'rows' => 4,
    'description' => null,
])

<flux:textarea
    :name="$name"
    :label="$label"
    :rows="$rows"
    :description="$description"
    {{ $attributes }}
>{{ old($name, $value) }}</flux:textarea>
