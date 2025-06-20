@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="max-w-md mx-auto mt-16 bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Buat Akun Baru</h2>
        <form method="POST" action="{{ route('register') }}">
            <div class="flex flex-col gap-4">
                @csrf
                <x-input placeholder="Name" name="name" />
                <x-input placeholder="Email"  name="email" type="email" />
                <x-input placeholder="BirthDate"  name="birthdate" type="date" />
                <x-input placeholder="Password"  name="password" type="password" />
                <x-input placeholder="Confirm Password"  name="password_confirmation" type="password" />
                <x-button variant="ghost" class="hover:bg-gray-100 cursor-pointer" type="submit">Daftar</x-button>
            </div>
        </form>
        <p class="mt-4 text-center text-sm">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
        </p>
    </div>
    @if (session('status'))
        <div class="mb-4 text-green-600">
            {{ session('status') }}
        </div>
    @endif

    @error('email')
        <div class="mb-2 text-red-600">{{ $message }}</div>
    @enderror

@endsection
