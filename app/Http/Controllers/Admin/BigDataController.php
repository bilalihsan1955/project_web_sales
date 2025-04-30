<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;

class BigDataController extends Controller
{
    /**
     * Display a listing of the customers.
     */
    public function index(Request $request)
    {
        // Membuat query untuk data Customer dengan relasi 'branch' dan 'salesman'
        $query = Customer::with(['branch', 'salesman']);

        // Filter berdasarkan branch jika ada di request
        if ($request->has('branch') && $request->branch != '') {
            $query->where('branch_id', $request->branch);
        }

        // Filter berdasarkan city jika ada di request
        if ($request->has('city') && $request->city != '') {
            $query->where('kota', $request->city);
        }

        // Filter berdasarkan progress jika ada di request
        if ($request->has('progress') && $request->progress != '') {
            $query->where('progress', $request->progress);
        }

        // Ambil jumlah item per halaman dari request, default 10 jika tidak ada
        $itemsPerPage = $request->has('itemsPerPage') ? $request->itemsPerPage : 10;

        // Ambil data customer dengan pagination berdasarkan jumlah item per halaman
        $customers = $query->paginate($itemsPerPage);

        // Ambil data cabang yang ada di database
        $branches = Branch::all();

        // Ambil daftar kota yang ada di database secara unik
        $cities = Customer::select('kota')->distinct()->get();

        // Menampilkan view BigData dan mengirim data customer, cabang, dan kota ke front-end
        return view('Admin.BigData.bigdata', compact('customers', 'branches', 'cities'));
    }

    /**
     * Store a newly created customer in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'progress' => 'required|string|in:Pending,SPK,DO,Invalid', // Update validasi progress
            'alasan' => 'nullable|string',
            'branch_id' => 'required|exists:branches,id',
            'salesman' => 'nullable|string',
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'kelurahan' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kota' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'tipe_pelanggan' => 'nullable|string',
            'jenis_pelanggan' => 'nullable|string',
            'pekerjaan' => 'nullable|string',
            'tenor' => 'nullable|integer',
            'tanggal_gatepass' => 'nullable|date',
            'model_mobil' => 'nullable|string',
            'nomor_rangka' => 'nullable|string',
            'sumber_data' => 'nullable|string',
        ]);

        // Create new customer entry
        $customer = new Customer();
        $customer->progress = $request->progress;
        $customer->alasan = $request->alasan;
        $customer->branch_id = $request->branch_id;
        $customer->salesman = $request->salesman;
        $customer->nama = $request->nama;
        $customer->alamat = $request->alamat;
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
        $customer->save();

        // Redirect back with success message
        return redirect()->route('admin.bigdata')->with('success', 'Customer added successfully!');
    }

    /**
     * Show the specified customer details.
     */
    public function show($id)
    {
        // Menampilkan detail customer berdasarkan ID
        $customer = Customer::with(['branch', 'salesman'])->findOrFail($id);
        
        // Mengembalikan respons JSON dengan data customer
        return response()->json($customer);
    }

    /**
     * Remove the specified customer from storage.
     */
    public function destroy($id)
    {
        // Hapus data customer berdasarkan ID
        $customer = Customer::findOrFail($id);
        $customer->delete();

        // Mengembalikan respons JSON setelah berhasil hapus
        return redirect()->route('admin.bigdata')->with('success', 'Customer deleted successfully!');
    }

    // Restore Delete
    public function restore($id)
    {
        $customer = Customer::withTrashed()->findOrFail($id);

        // Restore customer
        $customer->restore();

        return redirect()->route('admin.bigdata')->with('success', 'Customer restored successfully!');
    }
}
