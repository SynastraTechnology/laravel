@props([
    'align' => 'center',
    'side' => 'bottom',
    'sideOffset' => 4,
])
@php
    $alignment = $side . ['center' => '', 'end' => '-end', 'start' => '-start'][$align];
@endphp
<ul x-dropdown-menu:items x-transition:enter.origin.top.right
    x-anchor.{{ $alignment }}.offset.{{ $sideOffset }}="document.getElementById($id('alpine-dropdown-menu-button'))"
    x-cloak class="absolute min-w-[8rem] rounded-md bg-white shadow-md right-5">
    {{ $slot }}
</ul>
