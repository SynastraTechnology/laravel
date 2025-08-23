<?php
namespace Modules\PixelArt\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PixelArtController extends Controller
{
    /**
     * Display the main pixel art converter page
     */
    public function index()
    {
        return view('pixelart::index');
    }

    /**
     * Display the pixel art converter tool
     */
    public function converter()
    {
        return view('pixelart::converter');
    }

    /**
     * Display the converted images gallery
     */
    public function gallery()
    {
        return view('pixelart::gallery');
    }

    /**
     * Process image upload and convert to pixel art
     */
    public function process(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'pixel_size' => 'required|integer|min:2|max:50',
            'contrast' => 'nullable|integer|min:-100|max:100',
            'brightness' => 'nullable|integer|min:-100|max:100',
            'saturation' => 'nullable|integer|min:-100|max:100',
            'color_palette' => 'nullable|string|in:original,grayscale,monochrome,vibrant,pastel',
            'dithering' => 'nullable|boolean',
        ]);

        // Handle image upload and processing
        $image = $request->file('image');
        $path = $image->store('temp', 'public');
        
        // In a real implementation, you would process the image here
        // For now, we'll return the path for demonstration
        
        return response()->json([
            'success' => true,
            'message' => 'Image uploaded successfully',
            'path' => $path,
            'settings' => $request->only(['pixel_size', 'contrast', 'brightness', 'saturation', 'color_palette', 'dithering'])
        ]);
    }

    /**
     * Download the processed pixel art
     */
    public function download(Request $request)
    {
        $request->validate([
            'filename' => 'required|string',
        ]);

        $path = storage_path('app/public/' . $request->filename);
        
        if (!file_exists($path)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        return response()->download($path);
    }
}
