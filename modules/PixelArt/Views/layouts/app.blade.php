@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <nav class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('pixelart.index') }}" class="text-xl font-bold text-gray-800">
                        Pixel Art Studio
                    </a>
                    <div class="hidden md:flex space-x-4">
                        <a href="{{ route('pixelart.index') }}" class="text-gray-600 hover:text-gray-800">Home</a>
                        <a href="{{ route('pixelart.editor') }}" class="text-gray-600 hover:text-gray-800">Editor</a>
                        <a href="{{ route('pixelart.gallery') }}" class="text-gray-600 hover:text-gray-800">Gallery</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="text-gray-600 hover:text-gray-800">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                    <button class="text-gray-600 hover:text-gray-800">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-white border-t mt-12">
        <div class="container mx-auto px-4 py-8">
            <div class="text-center text-gray-600">
                <p>&copy; 2024 Pixel Art Studio. Create amazing pixel art with ease.</p>
            </div>
        </div>
    </footer>
</div>
@endsection
