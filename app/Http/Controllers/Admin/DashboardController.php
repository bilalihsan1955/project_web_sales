<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Branch;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all customers including invalid ones for total count
        $allCustomers = Customer::with(['branch', 'salesman'])
            ->orderBy('created_at', 'desc') // Urutkan dari yang terbaru
            ->get();
        
        // Fetch valid customers with salesman, ordered by latest
        $validCustomers = Customer::whereNotIn('progress', ['Invalid'])
            ->whereNotNull('salesman_id')
            ->with(['branch', 'salesman'])
            ->orderBy('created_at', 'desc') // Urutkan dari yang terbaru
            ->get();

        // Counting customers
        $totalAllCustomers = $allCustomers->count();
        $totalValidCustomers = $validCustomers->count();
        $invalidCount = $allCustomers->where('progress', 'Invalid')->count();

        // Counting follow-ups and saved customers
        $followUpCount = $validCustomers->whereIn('progress', ['Pending', 'SPK', 'DO'])->count();
        $savedCount = $validCustomers->where('saved', 1)->count();

        // Group by salesman with proper counting
        $salesmenData = [];
        $salesmanIds = []; // Untuk menjaga urutan salesman

        foreach ($validCustomers as $index => $customer) {
            $salesman = $customer->salesman;
            if ($salesman) {
                if (!isset($salesmenData[$salesman->id])) {
                    $salesmenData[$salesman->id] = [
                        'no' => count($salesmanIds) + 1, // Nomor urut
                        'branch' => $customer->branch,
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

        // Get unique cities
        $cities = Branch::select('name as city')
            ->whereNotNull('name')
            ->distinct()
            ->orderBy('name')
            ->pluck('city');

        return view('Admin.Dashboard.Dashboard', compact(
            'totalAllCustomers',
            'totalValidCustomers',
            'invalidCount',
            'followUpCount',
            'savedCount',
            'salesmenData',
            'cities'
        ));
    }
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
