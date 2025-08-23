@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="container mx-auto p-4 max-w-lg">
    <h1 class="text-xl font-bold mb-4">Tambah Produk</h1>

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <x-input name="name" placeholder="Nama Produk" />
        <x-textarea name="description" placeholder="Deskripsi" />
        <x-input name="price" type="number" placeholder="Harga" />
        <x-input name="stock" type="number" placeholder="Stok" />
        <x-input name="image" type="file" placeholder="Gambar Produk" />

        <x-button class="w-full" type="submit">Simpan</x-button>
    </form>
</div>
@endsection