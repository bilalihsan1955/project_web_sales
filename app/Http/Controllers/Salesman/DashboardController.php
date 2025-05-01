<?php

namespace App\Http\Controllers\Salesman;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil user yang login (salesman)
        $salesman = auth()->user(); // Ambil data lengkap user login

        // Ambil seluruh data customer yang memiliki cabang yang sama dengan salesman
        $customers = Customer::where('saved', 0)
            ->with(['branch', 'salesman'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Salesman.Dashboard.Dashboard', compact('customers'));
    }

    // fungsi save customer
    public function saveCustomer($id)
    {
        $customer = Customer::findOrFail($id);

        if ($customer->branch_id === auth()->user()->branch_id) {
            $customer->saved = 1;
            $customer->save();

            return redirect()->route('Salesman.Dashboard')->with('success', 'Customer telah disimpan.');
        }

        abort(403, 'Tidak memiliki akses untuk menyimpan customer ini.');
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
    public function destroy(string $id)
    {
        //
    }
}
