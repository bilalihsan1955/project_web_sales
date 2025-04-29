<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Branch;
use App\Models\User;  // Pastikan Anda menggunakan model User untuk salesman
use Illuminate\Http\Request;

class BigDataController extends Controller
{
    /**
     * Display a listing of the customers.
     */
    public function index()
    {
        // Ambil seluruh data customer dengan relasi branch dan salesman
        $customers = Customer::with(['branch', 'salesman'])->paginate(10);

        // Menampilkan view BigData dan mengirim data customer ke front-end
        return view('Admin.BigData.bigdata', compact('customers'));
    }

    /**
     * Store a newly created customer in storage.
     */
    public function store(Request $request)
    {
        // Validasi inputan customer
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'salesman_id' => 'nullable|exists:user,id',
            'nama' => 'required|string|max:255',
            'nomor_hp_1' => 'required|string',
            'nomor_hp_2' => 'nullable|string',
            'alamat' => 'nullable|string',
            'kelurahan' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kota' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'tipe_pelanggan' => 'nullable|in:first buyer,replacement,additional',
            'jenis_pelanggan' => 'nullable|in:Retail,Fleet',
            'pekerjaan' => 'nullable|string',
            'tenor' => 'nullable|integer',
            'tanggal_gatepass' => 'nullable|date',
            'model_mobil' => 'nullable|string',
            'nomor_rangka' => 'nullable|string',
            'sumber_data' => 'nullable|string',
            'progress' => 'nullable|in:Pending,Invalid,SPK,DO',
            'alasan' => 'nullable|string',
        ]);

        // Simpan data customer baru
        $customer = new Customer();
        $customer->branch_id = $request->branch_id;
        $customer->salesman_id = $request->salesman_id;
        $customer->nama = $request->nama;
        $customer->alamat = $request->alamat;
        $customer->nomor_hp_1 = $request->nomor_hp_1;
        $customer->nomor_hp_2 = $request->nomor_hp_2;
        $customer->kelurahan = $request->kelurahan;
        $customer->kecamatan = $request->kecamatan;
        $customer->kota = $request->kota;
        $customer->tanggal_lahir = $request->tanggal_lahir;
        $customer->jenis_kelamin = $request->jenis_kelamin;
        $customer->tipe_pelanggan = $request->tipe_pelanggan;
        $customer->jenis_pelanggan = $request->jenis_pelanggan;
        $customer->pekerjaan = $request->pekerjaan;
        $customer->tenor = $request->tenor;
        $customer->tanggal_gatepass = $request->tanggal_gatepass;
        $customer->model_mobil = $request->model_mobil;
        $customer->nomor_rangka = $request->nomor_rangka;
        $customer->sumber_data = $request->sumber_data;
        $customer->progress = $request->progress ?? 'Pending'; // Default progress is Pending
        $customer->alasan = $request->alasan;
        $customer->save();

        // Mengembalikan respons JSON setelah berhasil menambah data
        return redirect()->route('admin.bigdata')->with('success', 'Customer added successfully!');
    }

    /**
     * Show the specified customer details.
     */
    public function show($id)
    {
        // Menampilkan detail customer
        $customer = Customer::with(['branch', 'salesman'])->findOrFail($id);
        // Mengembalikan respons JSON dengan data customer
        return response()->json($customer);
    }

    /**
     * Remove the specified customer from storage.
     */
    public function destroy($id)
    {
        // Hapus data customer
        $customer = Customer::findOrFail($id);
        $customer->delete();

        // Mengembalikan respons JSON setelah berhasil hapus
        return redirect()->route('admin.bigdata')->with('success', 'Customer deleted successfully!');
    }
}
