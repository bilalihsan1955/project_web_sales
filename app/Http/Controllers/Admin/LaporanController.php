<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use App\Models\Branch;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Get users with 'sales' role only, including their associated 'branch' via customers
        $salesmen = User::where('role', 'salesman')
            ->with('customers.branch') // Ensure we load the branch related to each customer's salesman
            ->when($request->branch, function ($query) use ($request) {
                return $query->whereHas('customers', function ($q) use ($request) {
                    $q->where('branch_id', $request->branch);
                });
            })
            ->when($request->city, function ($query) use ($request) {
                return $query->whereHas('customers', function ($q) use ($request) {
                    $q->where('kota', $request->city);
                });
            })
            ->when($request->jenis_pelanggan, function ($query) use ($request) {
                return $query->whereHas('customers', function ($q) use ($request) {
                    $q->where('jenis_pelanggan', $request->jenis_pelanggan);
                });
            })
            ->get();

        // Process data to calculate percentages and other calculations
        $salesmanProgress = $salesmen->map(function ($salesman) {
            $totalFollowUp = $salesman->customers->count();
            $totalSPK = $salesman->customers->where('progress', 'SPK')->count();
            $totalPending = $salesman->customers->where('progress', 'pending')->count();
            $totalNonValid = $salesman->customers->where('progress', 'invalid')->count();

            // Calculate percentages
            $progressPercentage = $totalFollowUp > 0 ? ($totalFollowUp / $totalFollowUp) * 100 : 0;
            $spkPercentage = $totalFollowUp > 0 ? ($totalSPK / $totalFollowUp) * 100 : 0;
            $pendingPercentage = $totalFollowUp > 0 ? ($totalPending / $totalFollowUp) * 100 : 0;
            $nonValidPercentage = $totalFollowUp > 0 ? ($totalNonValid / $totalFollowUp) * 100 : 0;

            return [
                'salesman' => $salesman->name,
                'branch' => $salesman->customers->first()->branch->name ?? 'N/A', // Access branch via the first customer
                'totalFollowUp' => $totalFollowUp,
                'totalSPK' => $totalSPK,
                'totalPending' => $totalPending,
                'totalNonValid' => $totalNonValid,
                'progressPercentage' => round($progressPercentage, 2),
                'spkPercentage' => round($spkPercentage, 2),
                'pendingPercentage' => round($pendingPercentage, 2),
                'nonValidPercentage' => round($nonValidPercentage, 2),
            ];
        });

        // Fetch all available branches to populate the filter dropdown
        $branches = Branch::all();

        // Send data to the view
        return view('Admin.Laporan.Laporan', compact('salesmanProgress', 'branches'));
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
