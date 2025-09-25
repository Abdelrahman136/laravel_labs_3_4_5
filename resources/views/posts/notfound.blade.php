<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Not Found') }}
    </h2>
</x-slot>

<x-app-layout>
    <div class="max-w-2xl text-center mx-auto shadow-lg rounded-lg bg-white p-10 mt-10">
        <h1 class="text-3xl font-bold mb-4 text-red-500">Post Not Found</h1>
        <p class="mb-4">The post you are looking for does not exist.</p>
        <div class="flex justify-center space-x-2">
            <a href="{{ route('posts.index') }}"
                class="text-blue-600 transition border-1 rounded-lg px-2 py-1 hover:bg-blue-500 hover:text-white hover:border-blue-600">Back to Posts</a>
        </div>
    </div>
</x-app-layout>