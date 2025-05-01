<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::with('branch')->get();

        // Get all branches to display in the filter
        $branches = Branch::all();

        // Send the data to the view
        return view('Admin.UserManagement.UserManagement', compact('users', 'branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
        // Ambil semua cabang dari model Branch
        $branches = Branch::all();

        // Daftar roles yang tersedia untuk pilihan
        $roles = ['admin', 'kepala_cabang', 'supervisor', 'salesman'];

        // Daftar status yang tersedia
        $statuses = ['aktif', 'non-aktif'];

        // Kirim data ke view untuk form tambah user
        return view('Admin.UserManagement.UserManagement', compact('branches', 'roles', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validated = $request->validate([
            'cabang' => 'required',
            'nama' => 'required',
            'username' => 'required|unique:user,username',
            'password' => 'required',
            'role' => 'required',
            'status' => 'required',
        ]);

        // Simpan data user baru
        $user = new User();
        $user->branch_id = $request->cabang;  // Simpan cabang
        $user->name = $request->nama;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);  // Enkripsi password
        $user->role = $request->role;
        $user->status = $request->status;
        $user->save();

        // Jika menggunakan JS, return data response JSON
        if ($request->ajax()) {
            return response()->json(['success' => 'User berhasil ditambahkan']);
        }

        // Redirect kembali ke halaman user management
        return redirect()->route('usermanagement')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Return the user data as JSON
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id); // Temukan user berdasarkan ID atau gagal jika tidak ditemukan
        
        $user->delete(); // Hapus user dari database
        
        return redirect()->route('Admin.UserManagement.UserManagement')->with('success', 'User berhasil dihapus');
    }
}
