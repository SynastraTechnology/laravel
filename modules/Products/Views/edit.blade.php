@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="container mx-auto p-4 max-w-lg">
    <h1 class="text-xl font-bold mb-4">Edit Produk</h1>

    <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <x-input name="name" :value="old('name', $product->name)" placeholder="Nama Produk" />
        <x-textarea name="description" :value="old('description', $product->description)" placeholder="Deskripsi" />
        <x-input name="price" type="number" :value="old('price', $product->price)" placeholder="Harga" />
        <x-input name="stock" type="number" :value="old('stock', $product->stock)" placeholder="Stok" />
        <x-input name="image" type="file" placeholder="Gambar Produk" />

        <x-button class="w-full" type="submit">Perbarui</x-button>
    </form>
</div>
@endsection
