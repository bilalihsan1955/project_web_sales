<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\History;
use Carbon\Carbon;

class HistoriesSeeder extends Seeder
{
    public function run()
    {
        $salesmen = \DB::table('user')->where('role', 'salesman')->pluck('id');
        $branches = \DB::table('branches')->pluck('id');

        // Create monthly history for last 6 months
        for ($month = 1; $month <= 6; $month++) {
            $period = Carbon::now()->subMonths($month)->format('Y-m-01');
            
            foreach ($salesmen as $salesmanId) {
                $branchId = \DB::table('user')->where('id', $salesmanId)->value('branch_id');
                
                History::create([
                    'salesman_id' => $salesmanId,
                    'branch_id' => $branchId,
                    'periode' => $period,
                    'total_followups' => rand(15, 50),
                    'total_spk' => rand(5, 20),
                    'total_pending' => rand(3, 15),
                    'total_rejected' => rand(2, 10),
                    'created_at' => $period,
                    'updated_at' => $period,
                ]);
            }
        }
    }
}