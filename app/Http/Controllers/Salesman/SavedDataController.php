<?php

namespace App\Http\Controllers\Salesman;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class SavedDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan ID salesman yang login
        $salesmanId = auth()->user()->id;

        // Ambil customer yang sudah disimpan oleh salesman
        $savedCustomers = Customer::where('salesman_id', $salesmanId)
            ->where('saved', 1) // Status saved = 1
            ->with(['branch', 'salesman'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Salesman.SavedData.SavedData', compact('savedCustomers'));
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
        // Find the customer by id, including related data (e.g. branch, salesman)
        $customer = Customer::with(['branch', 'salesman'])->findOrFail($id);

        // Check if the customer has been marked as saved
        if ($customer->saved == 1) {
            // Send customer data to view

            //update tergantung viewnya nanti
            // return view('Salesman.SavedData.CustomerDetail', compact('customer'));
        } else {
            // If customer is not saved, redirect or show a message
            
            //update tergantung viewnya
            // return redirect()->route('salesman.saveddata.index')->with('error', 'Customer is not saved yet.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Get the customer by id and ensure the salesman is allowed to edit it
        $customer = Customer::findOrFail($id);

        // Check if the customer belongs to the logged-in salesman
        if ($customer->salesman_id !== auth()->user()->id) {

            // update tergantung viewnya
            return redirect()->route('Salesman.SavedData.SavedData')->with('error', 'You are not authorized to edit this customer.');
        }

        // Show the edit form for the customer

        // update tergantung viewnya
        // return view('Salesman.SavedData.EditCustomer', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'progress' => 'required|in:Pending,Invalid,SPK,DO',
            'alasan' => 'nullable|string|max:255',
        ]);

        // Find the customer by id
        $customer = Customer::findOrFail($id);

        // Check if the customer belongs to the logged-in salesman
        if ($customer->salesman_id !== auth()->user()->id) {
            return redirect()->route('Salesman.SavedData.SavedData')->with('error', 'You are not authorized to update this customer.');
        }

        // Update the progress and alasan fields
        $customer->progress = $request->input('progress');
        $customer->alasan = $request->input('alasan', $customer->alasan);

        // Save the updated customer
        $customer->save();

        // Redirect with success message
        return redirect()->route('Salesman.SavedData.SavedData')->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
