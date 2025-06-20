@props([
    'variant' => 'outline',
])

<x-button :$variant x-on:click="__dialogOpen = false" type="submit">
    @if ($slot->isEmpty())
        {{ __('Close') }}
    @else
        {{ $slot }}
    @endif
</x-button>
