<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('author')->get();
        return response()->json(['message' => 'Posts retrieved successfully', 'data' => PostResource::collection($posts)], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|exists:users,id',
        ]);

        $post = Post::create($validateData);
        return response()->json(['message' => 'Post created successfully', 'data' => $post], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        if ($post) {
            return response()->json(['message' => 'Post retrieved successfully', 'data' => PostResource::make($post)], 200);
        } else {
            return response()->json(['message' => 'Post not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        if ($request->user()->id !== $post->author) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validateData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'author' => 'sometimes|required|exists:users,id',
        ]);

        $post->update($validateData);
        return response()->json(['message' => 'Post updated successfully', 'data' => $post], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'], 204);
    }
}
