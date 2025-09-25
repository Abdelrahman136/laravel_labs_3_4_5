<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit Post') }}
    </h2>
</x-slot>

<x-app-layout>
    <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
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

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Image</label>

                <div id="imageContainer" class="{{ $post->image_url ? '' : 'hidden' }}">
                    <img id="currentImage" src="{{ $post->image_url ? $post->image_url: '' }}" alt="Post Image" class="w-full h-64 object-cover rounded-lg border-2 border-gray-300 mb-2">
                    @if($post->image_url)
                    <p class="text-sm text-gray-600 mb-2">Current image</p>
                    @endif
                    <button type="button" id="removeCurrentImage" class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">Remove Image</button>
                </div>

                <div id="newImagePreview" class="hidden mb-4">
                    <img id="previewImg" src="" alt="New Image Preview" class="w-full h-64 object-cover rounded-lg border-2 border-gray-300 mb-2">
                    <p class="text-sm text-gray-600 mb-2">New image preview</p>
                    <button type="button" id="removeNewImage" class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">Remove New Image</button>
                </div>

                <input type="file" id="image" name="image" accept="image/*"
                    class="mt-1 block w-full outline-0 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3">
                <input type="hidden" id="removeImageFlag" name="remove_image" value="0">
                @error('image')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <x-button class="w-full bg-yellow-600 hover:bg-yellow-700 text-white " type="submit">
                Edit Post
            </x-button>

        </div>

    </form>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('image');
        const imageContainer = document.getElementById('imageContainer');
        const newImagePreview = document.getElementById('newImagePreview');
        const previewImg = document.getElementById('previewImg');
        const removeCurrentImageBtn = document.getElementById('removeCurrentImage');
        const removeNewImageBtn = document.getElementById('removeNewImage');
        const removeImageFlag = document.getElementById('removeImageFlag');

        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    newImagePreview.classList.remove('hidden');
                    imageContainer.classList.add('hidden');
                    removeImageFlag.value = '0';
                };

                reader.readAsDataURL(file);
            }
        });

        if (removeCurrentImageBtn) {
            removeCurrentImageBtn.addEventListener('click', function() {
                imageContainer.classList.add('hidden');
                removeImageFlag.value = '1';
                imageInput.value = '';
            });
        }

        removeNewImageBtn.addEventListener('click', function() {
            imageInput.value = '';
            newImagePreview.classList.add('hidden');
            previewImg.src = '';

            if (removeImageFlag.value !== '1') {
                imageContainer.classList.remove('hidden');
            }
        });
    });
</script>