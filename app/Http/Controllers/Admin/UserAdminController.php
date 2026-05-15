<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    public function index()
    {
        $this->authorizeAdmin();

        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function makeAdmin(Request $request, User $user)
    {
        $this->authorizeAdmin();

        abort_unless($user->role !== 'admin', 403);


        $user->update(['role' => 'admin']);

        return redirect()->route('admin.users.index')->with('success', 'Đã cấp quyền admin');
    }

    public function removeAdmin(Request $request, User $user)
    {
        $this->authorizeAdmin();

        // Không cho gỡ quyền admin của chính admin đăng nhập (tránh khóa hệ thống)
        $currentUser = auth()->user();
        if ($user->id === $currentUser?->id) {
            return back()->with('success', 'Không thể gỡ quyền admin của chính bạn');
        }




        abort_unless($user->role === 'admin', 403);


        $user->update(['role' => 'user']);

        return redirect()->route('admin.users.index')->with('success', 'Đã gỡ quyền admin');
    }

    private function authorizeAdmin(): void
    {
        $user = auth()->user();
        abort_unless($user && $user->role === 'admin', 403);
    }
}



