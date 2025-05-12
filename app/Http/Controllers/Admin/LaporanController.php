<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SalesmanProgressExport;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil semua user role 'salesman' dan cabang langsung
        $salesmen = User::where('role', 'salesman')
            ->with(['branch', 'customers']) // ambil langsung cabang dari user, bukan dari customer
            ->when($request->branch, function ($query) use ($request) {
                $query->where('branch_id', $request->branch);
            })
            ->when($request->city, function ($query) use ($request) {
                $query->whereHas('customers', function ($q) use ($request) {
                    $q->where('kota', $request->city);
                });
            })
            ->when($request->jenis_pelanggan, function ($query) use ($request) {
                $query->whereHas('customers', function ($q) use ($request) {
                    $q->where('jenis_pelanggan', $request->jenis_pelanggan);
                });
            })
            ->get();

        // Proses data sales
        $salesmanProgress = $salesmen->map(function ($salesman) {
            $totalFollowUp = $salesman->customers->count();
            $totalSPK = $salesman->customers->where('progress', 'SPK')->count();
            $totalPending = $salesman->customers->where('progress', 'pending')->count();
            $totalNonValid = $salesman->customers->where('progress', 'invalid')->count();

            // Hitung persentase
            $progressPercentage = $totalFollowUp > 0 ? 100 : 0;
            $spkPercentage = $totalFollowUp > 0 ? ($totalSPK / $totalFollowUp) * 100 : 0;
            $pendingPercentage = $totalFollowUp > 0 ? ($totalPending / $totalFollowUp) * 100 : 0;
            $nonValidPercentage = $totalFollowUp > 0 ? ($totalNonValid / $totalFollowUp) * 100 : 0;

            return [
                'salesman' => $salesman->name,
                'branch' => $salesman->branch->name ?? 'N/A', // ambil dari relasi branch langsung
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

        // Ambil semua cabang
        $branches = Branch::all();

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

    public function export(Request $request)
    {
        return Excel::download(new SalesmanProgressExport, 'salesman_progress.xlsx');
    }
}
