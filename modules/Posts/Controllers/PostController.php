<?php

namespace Modules\Posts\Controllers;

use Illuminate\Routing\Controller;
use Modules\Posts\Models\Post;
use Modules\Posts\Requests\StorePostRequest;
use Modules\Posts\Requests\UpdatePostRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('author')->latest()->paginate(10);
        return view('posts::posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts::posts.create');
    }

    public function store(StorePostRequest $request)
    {
        auth()->user()->posts()->create($request->validated());
        return redirect()->route('posts.index')->with('status', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        return view('posts::posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts::posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());
        return back()->with('status', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('status', 'Post deleted successfully.');
    }
}