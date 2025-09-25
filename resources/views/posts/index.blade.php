@extends('layout.layout')


@section('content')
<table class="min-w-full divide-y divide-gray-200 border border-gray-200 ">
    <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Title
            </th>
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Slug
            </th>
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Content
            </th>
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Author
            </th>
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Created At
            </th>
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Actions
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @if ($posts->isEmpty())
        <tr>
            <td colspan="5" class="text-center p-3">No posts found.</td>
        </tr>
        @else
        @foreach ($posts as $post)
        <tr>
            <td class="text-center p-3">{{ $post->title }}</td>
            <td class="text-center p-3">{{ $post->slug }}</td>
            <td class="text-center p-3">{{ $post->content }}</td>
            <td class="text-center p-3">{{ $post->author()->first()->name }}</td>
            <td class="text-center p-3">{{ $post->created_at }}</td>
            <td>
                <div class="flex justify-center space-x-2 mx-3">
                    <a href="{{ route('posts.show', $post) }}"
                        class="text-blue-600 transition border-1 rounded-lg px-2 py-1 hover:bg-blue-500 hover:text-white hover:border-blue-600">View</a>
                    <a href="{{ route('posts.edit', $post) }}"
                        class="text-yellow-600 transition border-1 rounded-lg px-2 py-1 hover:bg-yellow-500 hover:text-white hover:border-yellow-600">Edit</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="showDeleteModal(this.closest('form'))"
                            class="text-red-600 transition border-1 rounded-lg px-2 py-1 hover:bg-red-500 hover:text-white hover:border-red-600">Delete</button>
                    </form>
                </div>
            </td>
            </div>
            @endforeach
        </tr>
        @endif
    </tbody>
</table>
<div class="mt-4">
    {{ $posts->links() }}
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
                <x-button type="submit" class="text-red-600 hover:text-red-800 ml-4">Delete</x-button>
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