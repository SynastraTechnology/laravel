@extends('layouts.app')
@section('title', $post->title)
@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">{{ $post->title }}</h1>
        <p class="mb-4 text-gray-600">By {{ $post->author->name }} on {{ $post->created_at->format('d M Y') }}</p>
        <div class="prose">{!! nl2br(e($post->body)) !!}</div>
    </div>
@endsection
