<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Branch;
use Illuminate\Http\Request;

class InvalidDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mengambil data cabang untuk filter
        $branches = Branch::all(); // Pastikan Branch model sudah ada dan terhubung dengan benar
        
        // Mengambil data kota untuk filter
        $cities = Customer::distinct()->pluck('kota'); // Ambil semua kota yang berbeda dari data customer

        // Mengambil data jenis pelanggan untuk filter
        $jenisPelanggan = ['retail', 'fleet']; // Menetapkan opsi jenis pelanggan yang tersedia

        // Mengambil parameter filter dari request
        $branchFilter = $request->get('branch');
        $cityFilter = $request->get('city');
        $jenisPelangganFilter = $request->get('jenis_pelanggan');
        $itemsPerPage = $request->input('itemsPerPage', 10);

        // Mengambil data customer dengan progress invalid dan berdasarkan filter yang diterapkan
        $customers = Customer::where('progress', 'invalid')
            ->when($branchFilter, function ($query) use ($branchFilter) {
                return $query->whereHas('branch', function ($query) use ($branchFilter) {
                    $query->where('id', $branchFilter);
                });
            })
            ->when($cityFilter, function ($query) use ($cityFilter) {
                return $query->where('kota', $cityFilter);
            })
            ->when($jenisPelangganFilter, function ($query) use ($jenisPelangganFilter) {
                return $query->where('jenis_pelanggan', $jenisPelangganFilter);
            })
            ->paginate(10); // Menggunakan pagination untuk membatasi jumlah customer per halaman

        // Mengirim data ke view
        return view('Admin.InvalidData.Invaliddata', compact('customers', 'branches', 'cities', 'jenisPelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function destroy($id)
    {
        // Temukan customer berdasarkan ID
        $customer = Customer::findOrFail($id);

        // Hapus customer
        $customer->delete();

        // Redirect ke halaman yang sesuai setelah penghapusan
        return redirect()->route('admin.invaliddata')->with('success', 'Customer deleted successfully.');
    }
}
