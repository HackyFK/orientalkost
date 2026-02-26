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

        $owners = User::where('role', 'owner');
        $customers = User::where('role', 'customer');

        if ($search) {
            $owners->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('nomor_identitas', 'like', "%$search%");
            });

            $customers->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('nomor_identitas', 'like', "%$search%");
            });
        }

        $owners = $owners->latest()->paginate(10, ['*'], 'owners_page');
        $customers = $customers->latest()->paginate(10, ['*'], 'customers_page');

        $stats = [
            'owner' => User::where('role', 'owner')->count(),
            'customer' => User::where('role', 'customer')->count(),
        ];

        if ($request->ajax()) {
            // optional: pisahkan partial untuk owner & customer
            return view('admin.users.partials.table', compact('owners', 'customers'))->render();
        }

        return view('admin.users.index', compact('owners', 'customers', 'stats'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'User berhasil dihapus');
    }

    public function updateRole(User $user)
    {
        // dd($user->id, $user->role);

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

        return response()->json([
            'status' => $user->is_active
        ]);
    }
}
