@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <div class="p-6 bg-white rounded shadow">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-bold">Posts</h1>
            <a href="{{ route('posts.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">New Post</a>
        </div>
        @if (session('status'))
            <div class="mb-4 text-green-600">{{ session('status') }}</div>
        @endif
        <table class="w-full table-auto">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->author->name }}</td>
                        <td class="space-x-2">
                            <a href="{{ route('posts.show', $post) }}" class="text-blue-500">View</a>
                            <a href="{{ route('posts.edit', $post) }}" class="text-yellow-500">Edit</a>
                            <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">{{ $posts->links() }}</div>
    </div>
@endsection
