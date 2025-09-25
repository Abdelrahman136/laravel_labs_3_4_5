@extends('layout.layout')

@section('content')
<div class="max-w-2xl mx-auto shadow-lg rounded-lg bg-white p-10">
    <h1 class="text-2xl font-bold mb-4">{{$post->title}}</h1>
    <p class="mb-4">{{ $post->content }}</p>
    <p class="text-gray-600 mb-4">Author: {{$author}}</p>
    <p class="text-gray-600 mb-4">Created At: {{ $post->created_at }}</p>

    <div class="flex justify-center space-x-2">
        <a href="{{ route('posts.index') }}"
            class="text-blue-600 transition border-1 rounded-lg px-2 py-1 hover:bg-blue-500 hover:text-white hover:border-blue-600">Back to Posts</a>
        <a href="{{ route('posts.edit', $post) }}"
            class="text-yellow-600 transition border-1 rounded-lg px-2 py-1 hover:bg-yellow-500 hover:text-white hover:border-yellow-600">Edit</a>
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="button"
                onclick="showDeleteModal(this.closest('form'))"
                class="text-red-600 transition border-1 rounded-lg px-2 py-1 hover:bg-red-500 hover:text-white hover:border-red-600">Delete</button>
        </form>
    </div>
</div>

<div class="max-w-2xl mx-auto mt-8">
    <h2 class="text-xl font-bold mb-4">Comments</h2>
    <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-6">
        @csrf
        <input type="hidden" name="commentable_id" value="{{ $post->id }}">
        <input type="hidden" name="commentable_type" value="App\Models\Post">
        <textarea name="content" rows="3" class="w-full p-2 border rounded mb-4 resize-none" placeholder="Add a comment..."></textarea>
        <select name="user_id" class="w-full p-2 border rounded mb-4">
            @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Submit Comment</button>
    </form>

    @foreach($comments as $comment)
    <div class="bg-gray-100 p-4 mb-4 rounded">
        <p class="text-gray-800">{{ $comment->content }}</p>
        <p class="text-gray-600 text-sm mt-1">Posted by {{ $comment->user->name }} on {{ $comment->created_at->format('d-m-Y') }}</p>
    </div>
    @endforeach
</div>



<div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <div class="fixed bg-white rounded-lg shadow-lg p-6 z-50">
        <h2 class="text-lg font-bold mb-4">Confirm Deletion</h2>
        <p>Are you sure you want to delete this post?</p>
        <div class="flex justify-end mt-4">
            <button id="cancelDelete" onclick="hideDeleteModal()" class="text-gray-600 hover:text-gray-800">Cancel</button>
            <form id="confirmDeleteForm" action="" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-800 ml-4">Delete</button>
            </form>
        </div>
    </div>
    <div class="fixed inset-0 bg-gray-500/50"></div>
</div>

<script>
    function showDeleteModal(form) {
        const modal = document.getElementById('deleteModal');
        const confirmForm = document.getElementById('confirmDeleteForm');
        confirmForm.action = form.action;
        confirmForm.addEventListener('submit', function(event) {
            event.preventDefault();
            form.submit();
        });
        modal.classList.remove('hidden');
    }

    function hideDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
    }
</script>
@endsection