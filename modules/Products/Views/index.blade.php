@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Daftar Produk</h1>
    <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Produk</a>

    @if (session('status'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('status') }}</div>
    @endif

    <table class="w-full table-auto">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 text-left">Gambar</th>
                <th class="p-2 text-left">Nama</th>
                <th class="p-2 text-left">Deskripsi</th>
                <th class="p-2 text-left">Harga</th>
                <th class="p-2 text-left">Stok</th>
                <th class="p-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr class="border-b">
                <td class="p-2">
                    @if ($product->image)
                        <img src="{{ $product->image }}" class="w-16 h-16 object-cover rounded" alt="Gambar Produk">
                    @else
                        <span class="text-gray-400">Tidak ada</span>
                    @endif
                </td>
                <td class="p-2">{{ $product->name }}</td>
                <td class="p-2">{{ $product->description }}</td>
                <td class="p-2">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                <td class="p-2">{{ $product->stock }}</td>
                <td class="p-2 space-x-2">
                    <a href="{{ route('products.edit', $product) }}" class="text-blue-500">Edit</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection
