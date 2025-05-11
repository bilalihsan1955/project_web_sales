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
        $branches = Branch::all();

        $cities = Customer::select('kota')->distinct()->get();

        $customers = Customer::with(['branch', 'salesman'])
            ->where('progress', 'invalid')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Admin.InvalidData.Invaliddata', compact('branches', 'cities', 'customers'));
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
