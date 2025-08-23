<?php
namespace Modules\Products\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Modules\Products\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('products::index', compact('products'));
    }

    public function create()
    {
        return view('products::create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image',
        ]);

        // Upload ke Supabase jika ada gambar
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
                $data['image'] = config('services.supabase.url') . "/storage/v1/object/public/" . config('services.supabase.products_bucket') . "/{$filename}";
            }
        }

        Product::create($data);
        return redirect()->route('products.index')->with('status', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        return view('products::edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image',
        ]);

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
                $data['image'] = config('services.supabase.url') . "/storage/v1/object/public/" . config('services.supabase.products_bucket') . "/{$filename}";
            }
        }

        $product->update($data);
        return redirect()->route('products.index')->with('status', 'Produk diperbarui');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('status', 'Produk dihapus');
    }
}
