@props([
    'code',
])

<pre {{ $attributes->class('overflow-x-auto border border-line bg-code-bg p-4 text-sm leading-6 text-code-fg') }}><code>{{ $code }}</code></pre>
