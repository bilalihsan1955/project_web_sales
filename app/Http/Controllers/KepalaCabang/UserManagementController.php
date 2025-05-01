<?php

namespace App\Http\Controllers\KepalaCabang;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil cabang kepala cabang yang login
        $branchId = auth()->user()->branch_id;

        // Ambil data user yang hanya terkait dengan cabang kepala cabang yang login
        $users = User::where('branch_id', $branchId)
        ->whereIn('role', ['kepala_cabang', 'supervisor', 'salesman'])
        ->with('branch') // Load data cabang terkait
        ->get();

        // Ambil semua cabang untuk filter (hanya cabang yang terkait dengan kepala cabang yang login)
        $branches = Branch::where('id', $branchId)->get(); // Pastikan hanya cabang terkait yang diambil

        // Kirim data ke view
        return view('Kacab.UserManagement.UserManagement', compact('users', 'branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua cabang dari model Branch
        $branches = Branch::all();

        // Daftar roles yang tersedia untuk pilihan
        $roles = ['kepala_cabang', 'supervisor', 'salesman'];

        // Daftar status yang tersedia
        $statuses = ['aktif', 'non-aktif'];

        // Kirim data ke view untuk form tambah user
        return view('Kacab.UserManagement.UserManagement', compact('branches', 'roles', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input yang diterima dari form
        $validatedData = $request->validate([
            'username' => 'required|unique:user,username',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:kepala_cabang,supervisor,salesman',
            'status' => 'required|in:aktif,non-aktif',
            'branch_id' => 'required|exists:branches,id', // Validasi bahwa branch_id ada di tabel branches
        ]);

        // Hash password
        $validatedData['password'] = bcrypt($validatedData['password']);

        // Menyimpan data user baru
        $user = User::create($validatedData);

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('kepalacabang.user.index')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::with('branch')->findOrFail($id);

        // Pastikan hanya user dalam cabang yang sama bisa ditampilkan
        if (auth()->user()->role === 'kepala_cabang' && $user->branch_id !== auth()->user()->branch_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'username' => $user->username,
            'password' => $user->getOriginal('password'),
            'role' => $user->role,
            'status' => $user->status ?? 'N/A',
            'branch' => $user->branch->name ?? 'N/A',
        ]);
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
        $user = User::findOrFail($id);

        // Batasi akses: kepala cabang hanya boleh hapus user dari cabangnya
        if (auth()->user()->role === 'kepala_cabang' && $user->branch_id !== auth()->user()->branch_id) {
            return response()->json(['error' => 'Unauthorized. Anda hanya bisa menghapus akun dari cabang Anda.'], 403);
        }

        $user->delete();

        return response()->json(['success' => 'User berhasil dihapus.']);
    }
}
