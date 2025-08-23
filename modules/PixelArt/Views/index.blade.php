@extends('layouts.app')

@section('title', 'Pixel Art Converter - Home')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Hero Section -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Pixel Art Converter</h1>
        <p class="text-lg text-gray-600 mb-6">Transform your photos and images into stunning pixel art with adjustable settings</p>
        <div class="flex justify-center space-x-4">
            <a href="{{ route('pixelart.converter') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold">
                Start Converting
            </a>
            <a href="{{ route('pixelart.gallery') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold">
                View Gallery
            </a>
        </div>
    </div>

    <!-- Features Section -->
    <div class="grid md:grid-cols-3 gap-8 mb-12">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="text-blue-500 text-3xl mb-4">🖼️</div>
            <h3 class="text-xl font-semibold mb-2">Upload Any Image</h3>
            <p class="text-gray-600">Support JPG, PNG, GIF, and WebP formats up to 5MB</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="text-green-500 text-3xl mb-4">⚙️</div>
            <h3 class="text-xl font-semibold mb-2">Customizable Settings</h3>
            <p class="text-gray-600">Adjust pixel size, contrast, brightness, and color palettes</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="text-purple-500 text-3xl mb-4">💾</div>
            <h3 class="text-xl font-semibold mb-2">Download & Share</h3>
            <p class="text-gray-600">Save your pixel art creations and share with the community</p>
        </div>
    </div>

    <!-- How It Works -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold mb-4">How It Works</h2>
        <div class="grid md:grid-cols-4 gap-4">
            <div class="text-center">
                <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                    <span class="text-blue-600 font-bold">1</span>
                </div>
                <h4 class="font-semibold">Upload Image</h4>
                <p class="text-sm text-gray-600">Choose your photo or image</p>
            </div>
            <div class="text-center">
                <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                    <span class="text-green-600 font-bold">2</span>
                </div>
                <h4 class="font-semibold">Adjust Settings</h4>
                <p class="text-sm text-gray-600">Customize pixel size and effects</p>
            </div>
            <div class="text-center">
                <div class="bg-purple-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                    <span class="text-purple-600 font-bold">3</span>
                </div>
                <h4 class="font-semibold">Convert</h4>
                <p class="text-sm text-gray-600">Transform to pixel art</p>
            </div>
            <div class="text-center">
                <div class="bg-yellow-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                    <span class="text-yellow-600 font-bold">4</span>
                </div>
                <h4 class="font-semibold">Download</h4>
                <p class="text-sm text-gray-600">Save your creation</p>
            </div>
        </div>
    </div>
</div>
@endsection
