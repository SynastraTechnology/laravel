<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Synastra Starter Kit')</title>
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900 min-h-screen flex flex-col">
    @php
        $hideHeaderRoutes = ['login', 'register'];
    @endphp

    @if (!in_array(Route::currentRouteName(), $hideHeaderRoutes))
        <header class="bg-white shadow p-4">
            <div class="container mx-auto flex justify-between items-center">
                <a href="/" class="text-xl font-bold">Synastra</a>
                <nav class="space-x-4 flex items-center">
                    <a href="/" class="hover:underline">Home</a>
                    <a href="/dashboard" class="hover:underline">Dashboard</a>
                    <x-dropdown-menu>
                        <x-dropdown-menu.trigger
                            class="border-0 outline-none focus:outline-none focus:ring-0 hover:border-0 hover:outline-none hover:ring-0">
                            <x-avatar class="rounded-full overflow-hidden">
                                <x-avatar.image class="object-cover w-full h-full"
                                    src="{{ auth()->user()->profile_photo ?: asset('assets/user.png') }}"
                                    alt="Avatar" />
                            </x-avatar>
                        </x-dropdown-menu.trigger>
                        <x-dropdown-menu.content class="w-fit h-fit flex justify-center items-center">
                            <x-dropdown-menu.item>
                                <div class="w-full">
                                    <a href="{{ route('profile.edit') }}">
                                        <x-button variant="outline" class="w-full cursor-pointer">
                                            Edit Profil
                                        </x-button>
                                    </a>
                                </div>
                            </x-dropdown-menu.item>
                            <x-dropdown-menu.item>
                                <form method="POST" action="{{ route('logout') }}" class="w-full">
                                    @csrf
                                    <x-button variant="outline" type="submit"
                                        class="w-full cursor-pointer">Logout</x-button>
                                </form>
                            </x-dropdown-menu.item>
                        </x-dropdown-menu.content>
                    </x-dropdown-menu>
                </nav>
            </div>
        </header>
    @endif

    <main class="flex-1 container mx-auto p-6">
        @yield('content')
    </main>

    <footer class="bg-white shadow p-4 text-center text-sm">
        &copy; 2025 Synastra Starter Kit
    </footer>

</body>

</html>
