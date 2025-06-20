<div x-data="{ menuOpen: false }">
    <div x-dropdown-menu x-model="menuOpen" class="relative inline-block">
        {{ $slot }}
    </div>
</div>
