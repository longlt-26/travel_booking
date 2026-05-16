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
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $this->authorizeAdmin();
        
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Bạn không thể tự thay đổi quyền của chính mình');
        }

        $validated = $request->validate([
            'role' => 'required|in:admin,user',
        ]);

        $user->update($validated);
        return redirect()->back()->with('success', 'Cập nhật quyền hạn thành công');
    }

    public function destroy(User $user)
    {
        $this->authorizeAdmin();

        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Bạn không thể tự xóa chính mình');
        }

        $user->delete();
        return redirect()->back()->with('success', 'Xóa người dùng thành công');
    }

    private function authorizeAdmin(): void
    {
        abort_unless(auth()->check() && auth()->user()?->role === 'admin', 403);
    }
}
