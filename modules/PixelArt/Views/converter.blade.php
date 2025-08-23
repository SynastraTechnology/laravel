@extends('layouts.app')

@section('title', 'Pixel Art Converter')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Pixel Art Converter</h1>
        <div class="flex space-x-2">
            <a href="{{ route('pixelart.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Back to Home
            </a>
            <a href="{{ route('pixelart.gallery') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                View Gallery
            </a>
        </div>
    </div>

    <!-- Converter Container -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Upload & Settings Panel -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-4">
                <h3 class="text-lg font-semibold mb-4">Upload & Settings</h3>
                
                <!-- Upload Area -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Upload Image</label>
                    <label for="image-upload" class="cursor-pointer">
                        <div id="upload-area" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors hover:bg-gray-50">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <p class="mt-2 text-sm text-gray-600">
                                <span class="font-medium text-blue-600">Click to upload</span> or drag and drop
                            </p>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                        </div>
                    </label>
                    <input type="file" id="image-upload" class="hidden" accept="image/*">
                </div>

                <!-- Settings -->
                <div class="space-y-4">
                    <!-- Pixel Size -->
                    <div>
                        <label class="block text-sm font-medium mb-2">Pixel Size</label>
                        <input type="range" id="pixel-size" min="2" max="50" value="16" class="w-full">
                        <div class="flex justify-between text-xs text-gray-500">
                            <span>2px</span>
                            <span id="pixel-size-value">16px</span>
                            <span>50px</span>
                        </div>
                    </div>

                    <!-- Contrast -->
                    <div>
                        <label class="block text-sm font-medium mb-2">Contrast</label>
                        <input type="range" id="contrast" min="-100" max="100" value="0" class="w-full">
                        <div class="flex justify-between text-xs text-gray-500">
                            <span>-100</span>
                            <span id="contrast-value">0</span>
                            <span>100</span>
                        </div>
                    </div>

                    <!-- Brightness -->
                    <div>
                        <label class="block text-sm font-medium mb-2">Brightness</label>
                        <input type="range" id="brightness" min="-100" max="100" value="0" class="w-full">
                        <div class="flex justify-between text-xs text-gray-500">
                            <span>-100</span>
                            <span id="brightness-value">0</span>
                            <span>100</span>
                        </div>
                    </div>

                    <!-- Saturation -->
                    <div>
                        <label class="block text-sm font-medium mb-2">Saturation</label>
                        <input type="range" id="saturation" min="-100" max="100" value="0" class="w-full">
                        <div class="flex justify-between text-xs text-gray-500">
                            <span>-100</span>
                            <span id="saturation-value">0</span>
                            <span>100</span>
                        </div>
                    </div>

                    <!-- Color Palette -->
                    <div>
                        <label class="block text-sm font-medium mb-2">Color Palette</label>
                        <select id="color-palette" class="w-full border rounded px-3 py-2">
                            <option value="original">Original Colors</option>
                            <option value="grayscale">Grayscale</option>
                            <option value="monochrome">Monochrome</option>
                            <option value="vibrant">Vibrant</option>
                            <option value="pastel">Pastel</option>
                        </select>
                    </div>

                    <!-- Dithering -->
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" id="dithering" class="mr-2">
                            <span class="text-sm font-medium">Enable Dithering</span>
                        </label>
                    </div>

                    <!-- Convert Button -->
                    <button id="convert-btn" class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg disabled:opacity-50" disabled>
                        Convert to Pixel Art
                    </button>
                </div>
            </div>
        </div>

        <!-- Preview Area -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Preview</h3>
                    <button id="download-btn" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg hidden">
                        Download
                    </button>
                </div>
                
                <!-- Original Image -->
                <div class="mb-4">
                    <h4 class="text-sm font-medium mb-2">Original</h4>
                    <div id="original-preview" class="border rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center" style="height: 200px;">
                        <span class="text-gray-400">No image uploaded</span>
                    </div>
                </div>

                <!-- Pixel Art Result -->
                <div>
                    <h4 class="text-sm font-medium mb-2">Pixel Art Result</h4>
                    <div id="pixel-preview" class="border rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center" style="height: 200px;">
                        <span class="text-gray-400">Convert an image to see result</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Processing Modal -->
    <div id="processing-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-lg p-6">
            <div class="flex items-center">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500 mr-3"></div>
                <span>Processing your image...</span>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Pixel Art Converter JavaScript
let uploadedImage = null;
let convertedImage = null;

// File upload handling
document.getElementById('upload-area').addEventListener('click', () => {
    document.getElementById('image-upload').click();
});

document.getElementById('image-upload').addEventListener('change', handleImageUpload);

function handleImageUpload(e) {
    const file = e.target.files[0];
    if (!file) return;

    if (!file.type.startsWith('image/')) {
        alert('Please select an image file');
        return;
    }

    if (file.size > 5 * 1024 * 1024) {
        alert('File size must be less than 5MB');
        return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
        uploadedImage = e.target.result;
        displayOriginalImage(uploadedImage);
        document.getElementById('convert-btn').disabled = false;
    };
    reader.readAsDataURL(file);
}

function displayOriginalImage(src) {
    const preview = document.getElementById('original-preview');
    preview.innerHTML = `<img src="${src}" class="max-w-full max-h-full object-contain" alt="Original">`;
}

// Settings display updates
['pixel-size', 'contrast', 'brightness', 'saturation'].forEach(id => {
    const slider = document.getElementById(id);
    const display = document.getElementById(`${id}-value`);
    slider.addEventListener('input', () => {
        display.textContent = slider.value;
    });
});

// Convert button
document.getElementById('convert-btn').addEventListener('click', convertToPixelArt);

async function convertToPixelArt() {
    if (!uploadedImage) return;

    const formData = new FormData();
    const fileInput = document.getElementById('image-upload');
    formData.append('image', fileInput.files[0]);
    formData.append('pixel_size', document.getElementById('pixel-size').value);
    formData.append('contrast', document.getElementById('contrast').value);
    formData.append('brightness', document.getElementById('brightness').value);
    formData.append('saturation', document.getElementById('saturation').value);
    formData.append('color_palette', document.getElementById('color-palette').value);
    formData.append('dithering', document.getElementById('dithering').checked);

    document.getElementById('processing-modal').classList.remove('hidden');

    try {
        const response = await fetch('{{ route("pixelart.process") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        const data = await response.json();
        
        if (data.success) {
            // Simulate pixel art conversion (in real app, use processed image)
            displayPixelArtResult(uploadedImage);
            document.getElementById('download-btn').classList.remove('hidden');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error processing image');
    } finally {
        document.getElementById('processing-modal').classList.add('hidden');
    }
}

function displayPixelArtResult(src) {
    const preview = document.getElementById('pixel-preview');
    preview.innerHTML = `<img src="${src}" class="max-w-full max-h-full object-contain pixel-art-canvas" alt="Pixel Art">`;
}

// Download button
document.getElementById('download-btn').addEventListener('click', () => {
    if (convertedImage) {
        const link = document.createElement('a');
        link.download = 'pixel-art.png';
        link.href = convertedImage;
        link.click();
    }
});

// Drag and drop
const uploadArea = document.getElementById('upload-area');
uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.classList.add('border-blue-500');
});

uploadArea.addEventListener('dragleave', () => {
    uploadArea.classList.remove('border-blue-500');
});

uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.classList.remove('border-blue-500');
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        document.getElementById('image-upload').files = files;
        handleImageUpload({ target: { files } });
    }
});
</script>
@endpush
@endsection
