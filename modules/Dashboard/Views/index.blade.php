@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    {{-- Header Halaman --}}
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
            Dashboard
        </h1>
    </div>

    <div class="space-y-6">

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    {{-- Pastikan Anda memiliki komponen <x-avatar> atau ganti dengan tag <img> --}}
                    <img src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=7F9CF5&background=EBF4FF' }}"
                        alt="{{ Auth::user()->name }}" class="h-12 w-12 rounded-full" />
                    <div>
                        <h3 class="text-lg font-medium">Selamat datang kembali, {{ Auth::user()->name }}!</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Siap untuk memulai hari ini?</p>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Total Pengguna</p>
                <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white">1,204</p>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Penjualan Bulan Ini</p>
                <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white">Rp 15.7M</p>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Tiket Baru</p>
                <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white">8</p>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Laporan Dibuat</p>
                <p class="mt-1 text-3xl font-semibold text-gray-900 dark:text-white">23</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Navigasi Cepat</h3>
                <div class="mt-4 space-y-3">
                    <a href="#"
                        class="block w-full px-4 py-2 text-center text-white bg-indigo-600 rounded-md hover:bg-indigo-700">Kelola
                        Data (Contoh CRUD)</a>
                    <a href="#"
                        class="block w-full px-4 py-2 text-center text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">Riwayat
                        Pembayaran</a>
                    <a href="#"
                        class="block w-full px-4 py-2 text-center text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">Pengaturan
                        Aplikasi</a>
                </div>
            </div>
            <div class="lg:col-span-2 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Analitik Pendapatan (Contoh Grafik)</h3>
                <div class="mt-4 h-64 bg-gray-100 dark:bg-gray-700 rounded-md flex items-center justify-center">
                    <p class="text-gray-500">Komponen Grafik akan ditampilkan di sini</p>
                </div>
            </div>
        </div>

    </div>
@endsection
