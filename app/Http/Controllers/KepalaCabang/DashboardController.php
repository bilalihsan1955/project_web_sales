<?php

namespace App\Http\Controllers\KepalaCabang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Branch;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Ambil cabang kepala cabang yang login
    $branchId = auth()->user()->branch_id;

    $allCustomers = Customer::where('branch_id', $branchId)
        ->with(['branch', 'salesman'])
        ->orderBy('created_at', 'desc') // Sort by the latest
        ->get();

    // Ambil semua customer yang memiliki salesman dengan cabang yang sesuai dengan cabang kepala cabang yang login
    $validCustomers = Customer::whereHas('salesman', function($query) use ($branchId) {
        $query->where('branch_id', $branchId);  // Pastikan salesman terkait dengan cabang yang sama
    })
    ->whereNotIn('progress', ['Invalid'])
    ->whereNotNull('salesman_id')
    ->with(['branch', 'salesman'])
    ->orderBy('created_at', 'desc')
    ->get();

    // Menghitung total customer
    $totalAllCustomers = $allCustomers->count();
    $totalValidCustomers = $validCustomers->count();
    $invalidCount = $validCustomers->where('progress', 'Invalid')->count();

    // Menghitung follow-ups dan saved customers
    $followUpCount = $validCustomers->whereIn('progress', ['Pending', 'SPK', 'DO'])->count();
    $savedCount = $validCustomers->where('saved', 1)->count();

    // Group by salesman dengan perhitungan yang sesuai
    $salesmenData = [];
    $salesmanIds = []; // Untuk menjaga urutan salesman

    foreach ($validCustomers as $index => $customer) {
        $salesman = $customer->salesman;
        if ($salesman) {
            if (!isset($salesmenData[$salesman->id])) {
                $salesmenData[$salesman->id] = [
                    'no' => count($salesmanIds) + 1, // Nomor urut
                    'branch' => $salesman->branch,
                    'salesman' => $salesman,
                    'total_customers' => 0,
                    'follow_up_count' => 0,
                    'saved_count' => 0,
                    'latest_customer' => $customer->created_at // Untuk sorting
                ];
                $salesmanIds[] = $salesman->id;
            }

            // Increment counters
            $salesmenData[$salesman->id]['total_customers']++;

            // Count follow-ups
            if (in_array($customer->progress, ['Pending', 'SPK', 'DO'])) {
                $salesmenData[$salesman->id]['follow_up_count']++;
            }

            // Count saved customers
            if ($customer->saved == 1) {
                $salesmenData[$salesman->id]['saved_count']++;
            }

            // Update latest customer date if newer
            if ($customer->created_at > $salesmenData[$salesman->id]['latest_customer']) {
                $salesmenData[$salesman->id]['latest_customer'] = $customer->created_at;
            }
        }
    }

    // Sort salesmen by latest customer date (newest first)
    usort($salesmenData, function($a, $b) {
        return $b['latest_customer'] <=> $a['latest_customer'];
    });

    // Re-number the salesmen after sorting
    foreach ($salesmenData as $index => &$salesman) {
        $salesman['no'] = $index + 1;
    }

    // Ambil semua cabang untuk filter kota
    $cities = Branch::select('name as city')
        ->whereNotNull('name')
        ->where('id', $branchId) // Hanya ambil cabang yang terkait dengan kepala cabang yang login
        ->distinct()
        ->orderBy('name')
        ->pluck('city');

    // Kirim data ke view
    return view('Kacab.Dashboard.Dashboard', compact(
        'totalAllCustomers',        // Add this variable to the compact() to pass it to the view
        'totalValidCustomers',
        'invalidCount',
        'followUpCount',
        'savedCount',
        'salesmenData',
        'cities'
    ));
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
