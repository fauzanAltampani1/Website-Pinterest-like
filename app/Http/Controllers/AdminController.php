<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    // Show admin login page
    public function showAdminLogin()
    {
        return view('admin.login');
    }

    // Handle admin login with PIN
    public function loginAdmin(Request $request)
    {
        // Validate PIN input
        $request->validate([
            'pin' => 'required|string',
        ]);

        // Verify the admin PIN
        if ($request->pin === 'admin') {
            session(['is_admin' => true]);
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with('error', 'PIN yang Anda masukkan salah.');
    }

    // Display admin dashboard
    public function index()
    {
        if (!session('is_admin')) {
            return redirect()->route('admin.login')->with('error', 'Silakan login sebagai admin.');
        }

        // Fetch all users excluding admin
        $users = User::where('role', 'user')->get();

        return view('admin.dashboard', compact('users'));
    }

    // Handle user deletion
    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Tidak dapat menghapus akun admin.');
        }

        $user->delete();
        return redirect()->route('admin.dashboard')->with('success', 'User berhasil dihapus.');
    }

    // Handle admin logout
    public function logoutAdmin()
    {
        session()->forget('is_admin');
        return redirect()->route('admin.login')->with('success', 'Anda telah logout.');
    }
}