<x-app-layout>
    <!-- remake this table to display users -->
    <table class="min-w-full divide-y divide-gray-200 border border-gray-200 ">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Name
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Email
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    isAdmin
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @if ($users->isEmpty())
            <tr>
                <td colspan="5" class="text-center p-3">No users found.</td>
            </tr>
            @else
            @foreach ($users as $user)
            <tr>
                <td class="text-center p-3">{{ $user->name }}</td>
                <td class="text-center p-3">{{ $user->email }}</td>
                <td class="text-center p-3">{{ $user->is_admin ? 'Yes' : 'No' }}</td>
                <td class="text-center p-3">
                    <div class="flex items-center justify-center space-x-2">
                        <form method="POST" action="{{ route('admin.users.changeRole', $user->id) }}">
                            @csrf
                            @method('PATCH')
                            <select name="role" onchange="this.form.submit()" class="rounded-md px-3 py-1 bg-white text-sm">
                                <option value="user" {{ $user->is_admin ? '' : 'selected' }}>User</option>
                                <option value="admin" {{ $user->is_admin ? 'selected' : '' }}>Admin</option>
                            </select>
                        </form>

                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="showDeleteModal(this.closest('form'))"
                                class="text-red-600 border border-red-600 rounded-md px-3 py-1 hover:bg-red-500 hover:text-white transition">
                                Delete
                            </button>
                        </form>
                    </div>
                </td>
                </div>
                @endforeach
            </tr>
            @endif
        </tbody>
    </table>

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
</x-app-layout>