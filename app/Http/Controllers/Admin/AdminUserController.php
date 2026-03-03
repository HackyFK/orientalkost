<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $role   = $request->role;
        $sort   = $request->sort ?? 'created_at';
        $direction = $request->direction ?? 'desc';

        $query = User::where('role', '!=', 'admin'); // admin tidak ditampilkan

        // Filter role
        if ($role && in_array($role, ['owner', 'customer'])) {
            $query->where('role', $role);
        }

        // Search
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('nomor_identitas', 'like', "%$search%");
            });
        }

        // Sorting
        if (in_array($sort, ['name','email','role','is_active','created_at'])) {
            $query->orderBy($sort, $direction);
        }

        $users = $query->paginate(10)->withQueryString();

        $stats = [
            'owner' => User::where('role', 'owner')->count(),
            'customer' => User::where('role', 'customer')->count(),
        ];

        return view('admin.users.index', compact(
            'users',
            'stats',
            'direction'
        ));
    }

    public function updateRole(User $user)
    {
        if ($user->role === 'customer') {
            $user->update(['role' => 'owner']);
        }

        return back()->with('success', 'Role berhasil diubah menjadi owner');
    }

    public function toggleStatus(User $user)
    {
        $user->update([
            'is_active' => !$user->is_active
        ]);

        return back();
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User berhasil dihapus');
    }
}
