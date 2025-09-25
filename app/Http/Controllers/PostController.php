<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use \App\Jobs\PruneOldPostsJob;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = User::all();
        return view('posts.create', ['authors' => $authors]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request)
    {

        Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'author' => $request->input('author'),
        ]);


        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $users = User::all();
        $comments = $post->comments()->orderBy('created_at', 'desc')->get();

        if (!$post) {
            return view('posts.notfound');
        }

        $author = $post->author()->first()->name;
        return view('posts.show', ['post' => $post, 'author' => $author, 'users' => $users, 'comments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $authors = User::all();

        return view('posts.edit', ['post' => $post, 'authors' => $authors]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, string $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return view('posts.notfound');
        }

        $post->update($request->only(['title', 'content', 'author']));

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::destroy($id);
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    public function trashed()
    {
        $posts = Post::onlyTrashed()->paginate(5);
        return view('posts.trashed', ['posts' => $posts]);
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->find($id);
        if ($post) {
            $post->restore();
            return redirect()->route('posts.index')->with('success', 'Post restored successfully.');
        }
        return redirect()->route('posts.trashed')->with('error', 'Post not found.');
    }

    public function forceDelete($id)
    {
        $post = Post::withTrashed()->find($id);
        if ($post) {
            $post->forceDelete();
            return redirect()->route('posts.trashed')->with('success', 'Post permanently deleted.');
        }
        return redirect()->route('posts.trashed')->with('error', 'Post not found.');
    }

    public function pruneOldPosts()
    {
        PruneOldPostsJob::dispatch();
        return redirect()->route('posts.index')->with('success', 'Pruning old posts...');
    }
}
