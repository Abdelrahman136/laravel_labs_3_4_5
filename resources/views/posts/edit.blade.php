@extends('layout.layout')

@section('content')
<form action="{{ route('posts.update', $post->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="max-w-2xl mx-auto shadow-lg rounded-lg bg-white p-10">
        <h1 class="text-2xl font-bold mb-4">Edit Post</h1>

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" id="title" name="title"
                class="mt-1 block w-full outline-0 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3" value="{{ old('title', $post->title) }}">

            @error('title')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
            <textarea id="content" name="content" rows="4"
                class="mt-1 block w-full outline-0 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3">{{old('content', $post->content)}}</textarea>

            @error('content')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
            <select id="author" name="author" required
                class="mt-1 block w-full outline-0 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3">
                @foreach ($authors as $author)
                <option value="{{ $author->id }}" {{ $post->author == $author->id ? 'selected' : '' }}>
                    {{ $author->name }}
                </option>
                @endforeach
            </select>
        </div>

        <x-button class="w-full bg-yellow-600 hover:bg-yellow-700 text-white " type="submit">
            Edit Post
        </x-button>

    </div>

</form>
@endsection