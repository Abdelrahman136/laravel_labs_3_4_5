<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab</title>
    @vite('resources/css/app.css')

</head>

<body>
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-center h-16">
                <div>
                    <ul class="flex items-center space-x-3">
                        <li>
                            <a href="{{ route('posts.create') }}"
                                class="px-3 py-2 rounded-md text-sm font-medium bg-indigo-600 text-white hover:bg-indigo-700 transition">Create Post</a>
                        </li>
                        <li>
                            <a href="{{ route('posts.index') }}"
                                class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition">Posts</a>
                        </li>

                        <li>
                            <a href="{{ route('posts.trashed') }}"
                                class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-red-50 hover:text-red-700 transition">Trashed Posts</a>
                        </li>

                        <li>
                            <a href="{{ route('posts.pruneOld') }}"
                                class="px-3 py-2 ms-20 rounded-md text-sm font-medium text-gray-700 hover:bg-red-50 hover:text-red-700    transition">Prune Old Posts</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto p-4">
        @yield('content')
    </main>

</body>

</html>