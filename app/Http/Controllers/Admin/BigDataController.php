<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CustomersImport;
use Illuminate\Support\Facades\Session;

class BigDataController extends Controller
{
    /**
     * Display a listing of the customers.
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
     * Store a newly created customer in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'branch_id' => 'required|string|max:255',
            'salesman_id' => 'nullable|string|max:255',
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'nomor_hp_1' => 'nullable|string|max:255',
            'nomor_hp_2' => 'nullable|string|max:255',
            'kelurahan' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|string|in:L,P',
            'tipe_pelanggan' => 'nullable|string|max:255',
            'jenis_pelanggan' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'tenor' => 'nullable|integer',
            'tanggal_gatepass' => 'nullable|date',
            'model_mobil' => 'nullable|string|max:255',
            'nomor_rangka' => 'nullable|string|max:255',
            'sumber_data' => 'nullable|string|max:255',
            'progress' => 'required|string|max:255',
            'saved' => 'nullable|boolean',
            'alasan' => 'nullable|string|max:255',
            'old_salesman' => 'nullable|string|max:255',
        ]);

        Customer::create($validated);

        // Redirect kembali ke halaman big data dengan pesan sukses
        return redirect()->route('admin.bigdata')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Show the specified customer details.
     */
    public function show($id)
    {
        //
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

    public function import(Request $request)
    {
        // Validate the file upload
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048', // Excel or CSV files
        ]);

        try {
            // Check if the file is uploaded
            if ($request->hasFile('file')) {
                // Perform the import using the CustomersImport class
                Excel::import(new CustomersImport, $request->file('file'));

                // Success message after importing
                return redirect()->back()->with('success', 'Data customer berhasil diimpor.');
            } else {
                return redirect()->back()->with('error', 'No file selected for upload.');
            }
        } catch (\Exception $e) {
            // Catch any exceptions and show error message
            return redirect()->back()->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
        }
    }
}
