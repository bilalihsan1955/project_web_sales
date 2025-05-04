<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Customer;
use Illuminate\Http\Request;

class BigDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $branches = Branch::all();

        // Ambil daftar kota yang ada di database secara unik
        $cities = Customer::select('kota')->distinct()->get();

        // Ambil data dari model AdminSalesmanGoals
        $customers = Customer::with(['branch', 'salesman'])->get();

        return view('Admin.BigData.bigdata', compact('branches', 'cities', 'customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => 'required|string|max:255',
            'salesman_id' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nomor_hp_1' => 'required|string|max:255',
            'nomor_hp_2' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|in:L,P',
            'tipe_pelanggan' => 'required|string|max:255',
            'jenis_pelanggan' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'tenor' => 'required|integer',
            'tanggal_gatepass' => 'required|date',
            'model_mobil' => 'required|string|max:255',
            'nomor_rangka' => 'required|string|max:255',
            'sumber_data' => 'required|string|max:255',
            'progress' => 'required|string|max:255',
            'alasan' => 'required|string|max:255',
        ]);

        $customers = Customer::create([
            'branch_id' => $validated['branch_id'],
            'salesman_id' => $validated['salesman_id'],
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
            'nomor_hp_1' => $validated['nomor_hp_1'],
            'nomor_hp_2' => $validated['nomor_hp_2'],
            'kelurahan' => $validated['kelurahan'],
            'kecamatan' => $validated['kecamatan'],
            'kota' => $validated['kota'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'tipe_pelanggan' => $validated['tipe_pelanggan'],
            'jenis_pelanggan' => $validated['jenis_pelanggan'],
            'pekerjaan' => $validated['pekerjaan'],
            'tenor' => $validated['tenor'],
            'tanggal_gatepass' => $validated['tanggal_gatepass'],
            'model_mobil' => $validated['model_mobil'],
            'nomor_rangka' => $validated['nomor_rangka'],
            'sumber_data' => $validated['sumber_data'],
            'progress' => $validated['progress'],
            'alasan' => $validated['alasan'],
        ]);

        return redirect()->route('admin.bigdata')->with('success', 'Data berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

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
        // Hapus data customer berdasarkan ID
        $customers = Customer::findOrFail($id);
        $customers->delete();

        // Mengembalikan respons JSON setelah berhasil hapus
        return redirect()->route('admin.bigdata')->with('deleted', 'Data berhasil dihapus!');
    }
}
