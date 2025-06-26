@extends('layouts.app')
@section('title', 'Create Post')
@section('content')
    <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">New Post</h2>
        <form method="POST" action="{{ route('posts.store') }}">
            @csrf
            <x-input label="Title" name="title" />
            <x-textarea label="Body" name="body" class="mt-4" />
            <x-button class="mt-4" type="submit">Save Post</x-button>
        </form>
    </div>
@endsection
