<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch customers with a valid salesman and filter progress
        $customers = Customer::whereNotIn('progress', ['tidak ada', 'invalid'])
            ->whereNotNull('salesman_id') // Only include customers with a salesman
            ->with(['branch', 'salesman']) // Eager load relations
            ->get();

        // Counting customers by progress
        $totalCustomers = $customers->count();  // Total customers with a salesman

        // Counting follow-ups (progresses that are 'pending', 'spk', or 'do')
        $followUpCount = $customers->whereIn('progress', ['pending', 'spk', 'do'])->count();

        // Counting saved customers (where progress is 'saved')
        $savedCount = $customers->where('progress', 'saved')->count();

        // Counting fleet and retail customers
        $fleetCustomers = $customers->where('tipe_pelanggan', 'fleet')->count();
        $retailCustomers = $customers->where('tipe_pelanggan', 'retail')->count();

        // Group by salesman and calculate follow-ups and saved counts
        $salesmenData = [];

        foreach ($customers as $customer) {
            $salesman = $customer->salesman;
            if ($salesman) {
                // Initialize if salesman not already in the array
                if (!isset($salesmenData[$salesman->id])) {
                    $salesmenData[$salesman->id] = [
                        'branch' => $customer->branch,
                        'salesman' => $salesman,
                        'total_customers' => 0,
                        'follow_up_count' => 0,
                        'saved_count' => 0,
                    ];
                }

                // Increment total customers for this salesman
                $salesmenData[$salesman->id]['total_customers']++;

                // Count follow-ups and saved customers (updated progress logic)
                if (in_array($customer->progress, ['pending', 'spk', 'do'])) {
                    $salesmenData[$salesman->id]['follow_up_count']++;
                } elseif ($customer->progress == 'saved') {
                    $salesmenData[$salesman->id]['saved_count']++;
                }
            }
        }

        // Send data to the view
        return view('Admin.Dashboard.Dashboard', compact(
            'totalCustomers',
            'fleetCustomers',
            'retailCustomers',
            'followUpCount',
            'savedCount',
            'salesmenData'
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
