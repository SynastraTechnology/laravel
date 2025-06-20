@props([
    'variant' => 'ghost',
])

<x-button
    :$variant
    x-on:click="__dialogOpen = true"
>
    {{ $slot }}
</x-button>
