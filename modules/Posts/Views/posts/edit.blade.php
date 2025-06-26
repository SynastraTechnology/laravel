@extends('layouts.app')
@section('title', 'Edit Post')
@section('content')
    <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Edit Post</h2>
        <form method="POST" action="{{ route('posts.update', $post) }}">
            @csrf @method('PUT')
            <x-input label="Title" name="title" :value="old('title', $post->title)" />
            <x-textarea label="Body" name="body" class="mt-4">{{ old('body', $post->body) }}</x-textarea>
            <x-button class="mt-4">Update Post</x-button>
        </form>
    </div>
@endsection
