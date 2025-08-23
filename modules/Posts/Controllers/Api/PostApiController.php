<?php
namespace Modules\Posts\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Posts\Models\Post;
use Illuminate\Http\JsonResponse;

class PostApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->get('per_page', 10);
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $status = $request->get('status');
        
        $query = Post::query();
        
        if ($status) {
            $query->where('status', $status);
        }
        
        $posts = $query->orderBy($sortBy, $sortOrder)
            ->with('user')
            ->paginate($perPage);
            
        return response()->json([
            'data' => $posts->items(),
            'meta' => [
                'current_page' => $posts->currentPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total(),
                'last_page' => $posts->lastPage(),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'in:draft,published',
            'tags' => 'nullable|string',
            'featured_image' => 'nullable|string|max:500',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = $validated['status'] ?? 'draft';

        $post = Post::create($validated);

        return response()->json([
            'message' => 'Post created successfully',
            'data' => $post->load('user')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): JsonResponse
    {
        return response()->json([
            'data' => $post->load('user')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post): JsonResponse
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'status' => 'in:draft,published',
            'tags' => 'nullable|string',
            'featured_image' => 'nullable|string|max:500',
        ]);

        $post->update($validated);

        return response()->json([
            'message' => 'Post updated successfully',
            'data' => $post->load('user')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): JsonResponse
    {
        $this->authorize('delete', $post);

        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully'
        ], 204);
    }

    /**
     * Search posts by keyword
     */
    public function search(Request $request, $keyword): JsonResponse
    {
        $posts = Post::where('title', 'like', "%{$keyword}%")
            ->orWhere('content', 'like', "%{$keyword}%")
            ->orWhere('tags', 'like', "%{$keyword}%")
            ->with('user')
            ->paginate(10);

        return response()->json([
            'data' => $posts->items(),
            'meta' => [
                'current_page' => $posts->currentPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total(),
                'last_page' => $posts->lastPage(),
            ]
        ]);
    }

    /**
     * Get posts by user
     */
    public function getByUser(Request $request, $userId): JsonResponse
    {
        $posts = Post::where('user_id', $userId)
            ->with('user')
            ->paginate(10);

        return response()->json([
            'data' => $posts->items(),
            'meta' => [
                'current_page' => $posts->currentPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total(),
                'last_page' => $posts->lastPage(),
            ]
        ]);
    }

    /**
     * Publish a post
     */
    public function publish(Request $request, Post $post): JsonResponse
    {
        $this->authorize('update', $post);

        $post->update(['status' => 'published']);

        return response()->json([
            'message' => 'Post published successfully',
            'data' => $post
        ]);
    }

    /**
     * Unpublish a post
     */
    public function unpublish(Request $request, Post $post): JsonResponse
    {
        $this->authorize('update', $post);

        $post->update(['status' => 'draft']);

        return response()->json([
            'message' => 'Post unpublished successfully',
            'data' => $post
        ]);
    }
}
