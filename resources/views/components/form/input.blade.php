@props([
    'name',
    'label',
    'type' => 'text',
    'value' => null,
    'required' => false,
    'description' => null,
])

<flux:input
    :name="$name"
    :label="$label"
    :type="$type"
    :value="old($name, $value)"
    :required="$required"
    :description="$description"
    {{ $attributes }}
/>
