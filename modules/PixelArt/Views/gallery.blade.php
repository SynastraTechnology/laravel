@extends('layouts.app')

@section('title', 'Pixel Art Gallery')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Pixel Art Gallery</h1>
        <div class="flex space-x-2">
            <a href="{{ route('pixelart.converter') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                Convert New Image
            </a>
            <a href="{{ route('pixelart.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Back to Home
            </a>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white rounded-lg shadow-md p-4 mb-6">
        <div class="grid md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium mb-2">Search</label>
                <input type="text" id="search-input" placeholder="Search converted images..." 
                       class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">Pixel Size</label>
                <select id="pixel-size-filter" class="w-full border rounded px-3 py-2">
                    <option value="">All Sizes</option>
                    <option value="8">8px</option>
                    <option value="16">16px</option>
                    <option value="32">32px</option>
                    <option value="64">64px</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">Color Palette</label>
                <select id="palette-filter" class="w-full border rounded px-3 py-2">
                    <option value="">All Palettes</option>
                    <option value="original">Original</option>
                    <option value="grayscale">Grayscale</option>
                    <option value="monochrome">Monochrome</option>
                    <option value="vibrant">Vibrant</option>
                    <option value="pastel">Pastel</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">Sort By</label>
                <select id="sort-filter" class="w-full border rounded px-3 py-2">
                    <option value="newest">Newest</option>
                    <option value="oldest">Oldest</option>
                    <option value="popular">Most Popular</option>
                    <option value="name">Name A-Z</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="gallery-grid">
        <!-- Sample Converted Images -->
        @for($i = 1; $i <= 12; $i++)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="aspect-square bg-gray-100 flex items-center justify-center">
                    <div class="w-full h-full bg-gradient-to-br from-purple-400 to-pink-500 opacity-20 flex items-center justify-center">
                        <span class="text-white font-bold text-lg">Pixel {{ $i }}</span>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-lg mb-1">Converted Image {{ $i }}</h3>
                    <p class="text-gray-600 text-sm mb-2">Original: landscape.jpg</p>
                    <div class="flex justify-between items-center text-sm text-gray-500 mb-2">
                        <span>32px pixels</span>
                        <span>Vibrant palette</span>
                    </div>
                    <div class="flex justify-between items-center text-sm text-gray-500 mb-3">
                        <span>{{ rand(10, 100) }} downloads</span>
                        <span>{{ rand(1, 30) }} days ago</span>
                    </div>
                    <div class="flex space-x-2">
                        <button class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                            View
                        </button>
                        <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                            Download
                        </button>
                    </div>
                </div>
            </div>
        @endfor
    </div>

    <!-- Load More -->
    <div class="text-center mt-8">
        <button id="load-more" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg">
            Load More
        </button>
    </div>

    <!-- Empty State -->
    <div id="empty-state" class="text-center py-12 hidden">
        <div class="text-gray-400 text-6xl mb-4">🖼️</div>
        <h3 class="text-xl font-semibold text-gray-600 mb-2">No converted images yet</h3>
        <p class="text-gray-500 mb-4">Start converting your images to pixel art!</p>
        <a href="{{ route('pixelart.converter') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg">
            Convert Your First Image
        </a>
    </div>
</div>

@push('scripts')
<script>
// Gallery JavaScript
let currentPage = 1;
let isLoading = false;

// Filter functionality
document.getElementById('search-input').addEventListener('input', filterGallery);
document.getElementById('pixel-size-filter').addEventListener('change', filterGallery);
document.getElementById('palette-filter').addEventListener('change', filterGallery);
document.getElementById('sort-filter').addEventListener('change', filterGallery);

function filterGallery() {
    const search = document.getElementById('search-input').value.toLowerCase();
    const pixelSize = document.getElementById('pixel-size-filter').value;
    const palette = document.getElementById('palette-filter').value;
    const sort = document.getElementById('sort-filter').value;
    
    // In a real app, this would make an API call
    console.log('Filtering with:', { search, pixelSize, palette, sort });
    
    // Simulate filtering
    const items = document.querySelectorAll('#gallery-grid > div');
    let visibleCount = 0;
    
    items.forEach(item => {
        const title = item.querySelector('h3').textContent.toLowerCase();
        const shouldShow = !search || title.includes(search);
        
        if (shouldShow) {
            item.style.display = 'block';
            visibleCount++;
        } else {
            item.style.display = 'none';
        }
    });
    
    // Show/hide empty state
    const emptyState = document.getElementById('empty-state');
    if (visibleCount === 0) {
        emptyState.classList.remove('hidden');
    } else {
        emptyState.classList.add('hidden');
    }
}

// Load more functionality
document.getElementById('load-more').addEventListener('click', loadMore);

function loadMore() {
    if (isLoading) return;
    
    isLoading = true;
    const button = document.getElementById('load-more');
    button.textContent = 'Loading...';
    
    // Simulate API call
    setTimeout(() => {
        const grid = document.getElementById('gallery-grid');
        const startIndex = (currentPage * 12) + 1;
        
        for (let i = startIndex; i < startIndex + 12; i++) {
            const item = document.createElement('div');
            item.className = 'bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow';
            item.innerHTML = `
                <div class="aspect-square bg-gray-100 flex items-center justify-center">
                    <div class="w-full h-full bg-gradient-to-br from-blue-400 to-green-500 opacity-20 flex items-center justify-center">
                        <span class="text-white font-bold text-lg">Pixel ${i}</span>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-lg mb-1">Converted Image ${i}</h3>
                    <p class="text-gray-600 text-sm mb-2">Original: portrait.jpg</p>
                    <div class="flex justify-between items-center text-sm text-gray-500 mb-2">
                        <span>${[16, 32, 64][Math.floor(Math.random() * 3)]}px pixels</span>
                        <span>${['Original', 'Grayscale', 'Vibrant'][Math.floor(Math.random() * 3)]} palette</span>
                    </div>
                    <div class="flex justify-between items-center text-sm text-gray-500 mb-3">
                        <span>${Math.floor(Math.random() * 200)} downloads</span>
                        <span>${Math.floor(Math.random() * 60)} days ago</span>
                    </div>
                    <div class="flex space-x-2">
                        <button class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                            View
                        </button>
                        <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                            Download
                        </button>
                    </div>
                </div>
            `;
            grid.appendChild(item);
        }
        
        currentPage++;
        button.textContent = 'Load More';
        isLoading = false;
    }, 1000);
}

// Initialize
filterGallery();
</script>
@endpush
@endsection
