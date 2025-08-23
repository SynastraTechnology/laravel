<?php
namespace Modules\Products\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Modules\Products\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->get('per_page', 10);
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        
        $products = Product::orderBy($sortBy, $sortOrder)
            ->paginate($perPage);
            
        return response()->json([
            'data' => $products->items(),
            'meta' => [
                'current_page' => $products->currentPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
                'last_page' => $products->lastPage(),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'nullable|string|max:100',
        ]);

        // Handle image upload to Supabase
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'product_' . Str::slug($request->name) . '_' . time() . '.' . $file->extension();

            $response = Http::withHeaders([
                'apikey' => config('services.supabase.key'),
                'Authorization' => 'Bearer ' . config('services.supabase.key'),
            ])
                ->attach('file', fopen($file->getRealPath(), 'r'), $filename)
                ->post(config('services.supabase.url') . "/storage/v1/object/" . config('services.supabase.products_bucket') . "/{$filename}");

            if (!$response->failed()) {
                $validated['image'] = config('services.supabase.url') . "/storage/v1/object/public/" . config('services.supabase.products_bucket') . "/{$filename}";
            }
        }

        $product = Product::create($validated);

        return response()->json([
            'message' => 'Product created successfully',
            'data' => $product
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): JsonResponse
    {
        return response()->json([
            'data' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'nullable|string|max:100',
        ]);

        // Handle image upload to Supabase
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'product_' . Str::slug($request->name ?? $product->name) . '_' . time() . '.' . $file->extension();

            $response = Http::withHeaders([
                'apikey' => config('services.supabase.key'),
                'Authorization' => 'Bearer ' . config('services.supabase.key'),
            ])
                ->attach('file', fopen($file->getRealPath(), 'r'), $filename)
                ->post(config('services.supabase.url') . "/storage/v1/object/" . config('services.supabase.products_bucket') . "/{$filename}");

            if (!$response->failed()) {
                $validated['image'] = config('services.supabase.url') . "/storage/v1/object/public/" . config('services.supabase.products_bucket') . "/{$filename}";
            }
        }

        $product->update($validated);

        return response()->json([
            'message' => 'Product updated successfully',
            'data' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ], 204);
    }

    /**
     * Search products by keyword
     */
    public function search(Request $request, $keyword): JsonResponse
    {
        $products = Product::where('name', 'like', "%{$keyword}%")
            ->orWhere('description', 'like', "%{$keyword}%")
            ->paginate(10);

        return response()->json([
            'data' => $products->items(),
            'meta' => [
                'current_page' => $products->currentPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
                'last_page' => $products->lastPage(),
            ]
        ]);
    }

    /**
     * Get products by category
     */
    public function getByCategory(Request $request, $category): JsonResponse
    {
        $products = Product::where('category', $category)
            ->paginate(10);

        return response()->json([
            'data' => $products->items(),
            'meta' => [
                'current_page' => $products->currentPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
                'last_page' => $products->lastPage(),
            ]
        ]);
    }

    /**
     * Update product stock
     */
    public function updateStock(Request $request, Product $product): JsonResponse
    {
        $validated = $request->validate([
            'stock' => 'required|integer|min:0'
        ]);

        $product->update(['stock' => $validated['stock']]);

        return response()->json([
            'message' => 'Stock updated successfully',
            'data' => $product
        ]);
    }

    /**
     * Get low stock products
     */
    public function getLowStock(Request $request): JsonResponse
    {
        $threshold = $request->get('threshold', 5);
        $products = Product::where('stock', '<=', $threshold)
            ->orderBy('stock', 'asc')
            ->paginate(10);

        return response()->json([
            'data' => $products->items(),
            'meta' => [
                'current_page' => $products->currentPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
                'last_page' => $products->lastPage(),
            ]
        ]);
    }
}
