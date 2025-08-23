<?php
namespace Modules\PixelArt\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class PixelArtApiController extends Controller
{
    /**
     * Generate pixel art from uploaded image
     */
    public function generate(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pixel_size' => 'required|integer|min:1|max:100',
            'color_palette' => 'nullable|string|in:grayscale,monochrome,vibrant,pastel',
            'brightness' => 'nullable|integer|min:-100|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $image = $request->file('image');
        $pixelSize = $request->input('pixel_size', 16);
        $colorPalette = $request->input('color_palette', 'vibrant');
        $brightness = $request->input('brightness', 0);

        // Process image to pixel art
        $processedImage = $this->processToPixelArt($image, $pixelSize, $colorPalette, $brightness);

        return response()->json([
            'message' => 'Pixel art generated successfully',
            'data' => [
                'original_filename' => $image->getClientOriginalName(),
                'pixel_size' => $pixelSize,
                'color_palette' => $colorPalette,
                'brightness' => $brightness,
                'image_data' => $processedImage
            ]
        ]);
    }

    /**
     * Upload image for pixel art processing
     */
    public function upload(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pixel_size' => 'required|integer|min:1|max:100',
            'color_palette' => 'nullable|string|in:grayscale,monochrome,vibrant,pastel',
            'brightness' => 'nullable|integer|min:-100|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $image = $request->file('image');
        $pixelSize = $request->input('pixel_size', 16);
        $colorPalette = $request->input('color_palette', 'vibrant');
        $brightness = $request->input('brightness', 0);

        // Process image to pixel art
        $processedImage = $this->processToPixelArt($image, $pixelSize, $colorPalette, $brightness);

        return response()->json([
            'message' => 'Image uploaded and processed successfully',
            'data' => [
                'original_filename' => $image->getClientOriginalName(),
                'pixel_size' => $pixelSize,
                'color_palette' => $colorPalette,
                'brightness' => $brightness,
                'image_data' => $processedImage
            ]
        ]);
    }

    /**
     * Get pixel art presets
     */
    public function getPresets(Request $request): JsonResponse
    {
        $presets = [
            'presets' => [
                [
                    'name' => '8-bit Classic',
                    'pixel_size' => 8,
                    'color_palette' => 'monochrome',
                    'brightness' => 0
                ],
                [
                    'name' => '16-bit Retro',
                    'pixel_size' => 16,
                    'color_palette' => 'vibrant',
                    'brightness' => 10
                ],
                [
                    'name' => '32-bit Modern',
                    'pixel_size' => 32,
                    'color_palette' => 'pastel',
                    'brightness' => -10
                ],
                [
                    'name' => '64-bit HD',
                    'pixel_size' => 64,
                    'color_palette' => 'grayscale',
                    'brightness' => 0
                ]
            ]
        ];

        return response()->json($presets);
    }

    /**
     * Download pixel art
     */
    public function download(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'image_data' => 'required|string',
            'filename' => 'required|string',
            'format' => 'required|string|in:png,jpeg,webp',
            'quality' => 'nullable|integer|min:1|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Return base64 encoded image
        return response()->json([
            'message' => 'Pixel art ready for download',
            'data' => [
                'filename' => $request->input('filename'),
                'format' => $request->input('format', 'png'),
                'image_data' => $request->input('image_data')
            ]
        ]);
    }

    /**
     * Process image to pixel art
     */
    private function processToPixelArt($image, $pixelSize, $colorPalette, $brightness)
    {
        // This would be implemented with JavaScript on the frontend
        // For now, return a placeholder response
        return [
            'base64' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg==',
            'width' => 100,
            'height' => 100,
            'pixel_size' => $pixelSize,
            'color_palette' => $colorPalette,
            'brightness' => $brightness
        ];
    }
}
