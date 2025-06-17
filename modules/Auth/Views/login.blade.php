@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="max-w-md mx-auto mt-28 bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="flex flex-col gap-4">
                <x-input label="Email" placeholder="Email" name="email" type="email" />
                <x-input label="Password" placeholder="Password" name="password" type="password" />
                <x-button variant="ghost" class="hover:bg-gray-100 cursor-pointer">Masuk</x-button>
            </div>
        </form>
        <p class="mt-4 text-center text-sm">
            Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar</a>
        </p>
    </div>
@endsection
