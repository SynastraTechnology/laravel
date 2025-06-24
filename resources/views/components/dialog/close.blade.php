@props([
    'variant' => 'outline',
])

<x-button :$variant x-on:click="__dialogOpen = false" class="cursor-pointer outline-none opacity-0" >
    @if ($slot->isEmpty())
        {{ __('Close') }}
    @else
        {{ $slot }}
    @endif
</x-button>
