<?php

namespace App\Http\Controllers\Supervisor;

use App\Models\User;
use App\Models\SupervisorSalesman;
use App\Models\Customer;
use App\Models\Branch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get the supervisor ID of the currently logged-in user
        $supervisorId = auth()->user()->id;

        // Fetch all customers with their related salesmen (those supervised by the logged-in supervisor)
        $allCustomers = Customer::with(['branch', 'salesman'])
            ->whereHas('salesman', function ($query) use ($supervisorId) {
                $query->whereHas('supervisors', function ($q) use ($supervisorId) {
                    $q->where('supervisor_id', $supervisorId); // Filter salesmen by supervisor
                });
            })
            ->orderBy('created_at', 'desc') // Sort by the latest
            ->get();

        // Fetch valid customers (those with progress not 'Invalid') and their related salesmen, ordered by the latest
        $validCustomers = Customer::whereNotIn('progress', ['Invalid'])
            ->whereNotNull('salesman_id')
            ->whereHas('salesman', function ($query) use ($supervisorId) {
                $query->whereHas('supervisors', function ($q) use ($supervisorId) {
                    $q->where('supervisor_id', $supervisorId); // Filter salesmen by supervisor
                });
            })
            ->with(['salesman.branch']) // Load the branch related to each salesman
            ->orderBy('created_at', 'desc')
            ->get();

        // Count total customers and valid customers
        $totalAllCustomers = $allCustomers->count();
        $totalValidCustomers = $validCustomers->count();
        $invalidCount = $allCustomers->where('progress', 'Invalid')->count();

        // Count follow-ups and saved customers
        $followUpCount = $validCustomers->whereIn('progress', ['Pending', 'SPK', 'DO'])->count();
        $savedCount = $validCustomers->where('saved', 1)->count();

        // Group by salesman and calculate relevant stats
        $salesmenData = [];
        $salesmanIds = []; // To maintain salesman order

        foreach ($validCustomers as $index => $customer) {
            $salesman = $customer->salesman;
            if ($salesman) {
                if (!isset($salesmenData[$salesman->id])) {
                    $salesmenData[$salesman->id] = [
                        'no' => count($salesmanIds) + 1, // Numbering the salesman
                        'branch' => $salesman->branch->name ?? 'N/A', // Get branch name from salesman
                        'salesman' => $salesman,
                        'total_customers' => 0,
                        'follow_up_count' => 0,
                        'saved_count' => 0,
                        'latest_customer' => $customer->created_at // For sorting purposes
                    ];
                    $salesmanIds[] = $salesman->id;
                }

                // Increment the counters
                $salesmenData[$salesman->id]['total_customers']++;

                if (in_array($customer->progress, ['Pending', 'SPK', 'DO'])) {
                    $salesmenData[$salesman->id]['follow_up_count']++;
                }

                if ($customer->saved == 1) {
                    $salesmenData[$salesman->id]['saved_count']++;
                }

                if ($customer->created_at > $salesmenData[$salesman->id]['latest_customer']) {
                    $salesmenData[$salesman->id]['latest_customer'] = $customer->created_at;
                }
            }
        }

        // Sort salesmen by latest customer date (newest first)
        usort($salesmenData, function ($a, $b) {
            return $b['latest_customer'] <=> $a['latest_customer'];
        });

        // Re-number the salesmen after sorting
        foreach ($salesmenData as $index => &$salesman) {
            $salesman['no'] = $index + 1;
        }

        // Get unique cities based on the salesmen's branch
        $cities = Branch::select('name as city')
            ->whereNotNull('name')
            ->distinct()
            ->orderBy('name')
            ->pluck('city');

        // Return view with the processed data
        return view('Supervisor.Dashboard.Dashboard', compact(
            'totalAllCustomers',
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
