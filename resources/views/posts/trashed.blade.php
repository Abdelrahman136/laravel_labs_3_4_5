<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Trashed Posts') }}
    </h2>
</x-slot>

<x-app-layout>
    <table class="min-w-full divide-y divide-gray-200 border border-gray-200 ">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Title
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
                <td class="text-center p-3">{{ $post->content }}</td>
                <td class="text-center p-3">{{ $post->author()->first()->name }}</td>
                <td class="text-center p-3">{{ $post->created_at }}</td>
                <td>
                    <div class="flex justify-center space-x-2">
                        <a href="{{ route('posts.restore', $post->id) }}"
                            class="text-green-600 transition border-1 rounded-lg px-2 py-1 hover:bg-green-500 hover:text-white hover:border-green-600">Restore</a>
                        <a href="{{ route('posts.forceDelete', $post->id) }}"
                            class="text-red-600 transition border-1 rounded-lg px-2 py-1 hover:bg-red-500 hover:text-white hover:border-red-600">Force Delete</a>

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
</x-app-layout>