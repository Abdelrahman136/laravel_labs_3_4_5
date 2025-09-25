<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{

    public function usersList()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function changeUserRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->is_admin = $request->input('role') === 'admin';
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User role updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'You cannot delete your own account.');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
