  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('New Post') }}
      </h2>
  </x-slot>

  <x-app-layout>
      <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="max-w-2xl mx-auto shadow-lg rounded-lg bg-white p-10">
              <h1 class="text-2xl font-bold mb-4">Create New Post</h1>

              <div class="mb-4">
                  <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                  <input type="text" id="title" name="title" value="{{old('title')}}"
                      class="mt-1 block w-full outline-0 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3">

                  @error('title')
                  <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                  @enderror
              </div>


              <div class="mb-4">
                  <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                  <textarea id="content" name="content" rows="4"
                      class="mt-1 block w-full outline-0 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3">{{old('content')}}</textarea>
                  @error('content')
                  <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                  @enderror
              </div>


              <div class="mb-4">
                  <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                  <select id="author" name="author" required
                      class="mt-1 block w-full outline-0 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3">
                      @foreach ($authors as $author)
                      <option value="{{ $author->id }}">
                          {{ $author->name }}
                      </option>
                      @endforeach
                  </select>
              </div>

              <div class="mb-4">
                  <label for="image" class="block text-sm font-medium text-gray-700">Image</label>

                  <div id="imagePreview" class="hidden mb-4">
                      <img id="previewImg" src="" alt="Image Preview" class="w-full h-64 object-cover rounded-lg border-2 border-gray-300">
                      <button type="button" id="removeImage" class="mt-2 px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">Remove Image</button>
                  </div>

                  <input type="file" id="image" name="image" accept="image/*"
                      class="mt-1 block w-full outline-0 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-3">
                  @error('image')
                  <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                  @enderror
              </div>

              <x-button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white ">
                  Create Post
              </x-button>

          </div>

      </form>
  </x-app-layout>

  <script>
      document.addEventListener('DOMContentLoaded', function() {
          const imageInput = document.getElementById('image');
          const imagePreview = document.getElementById('imagePreview');
          const previewImg = document.getElementById('previewImg');
          const removeImageBtn = document.getElementById('removeImage');

          imageInput.addEventListener('change', function(e) {
              const file = e.target.files[0];

              if (file) {
                  const reader = new FileReader();

                  reader.onload = function(e) {
                      previewImg.src = e.target.result;
                      imagePreview.classList.remove('hidden');
                  };

                  reader.readAsDataURL(file);
              }
          });

          removeImageBtn.addEventListener('click', function() {
              imageInput.value = '';
              imagePreview.classList.add('hidden');
              previewImg.src = '';
          });
      });
  </script>