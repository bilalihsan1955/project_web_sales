<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;  // Add this line

class BranchesSeeder extends Seeder
{
    public function run()
    {
        $branches = [
            ['name' => 'Jakarta Branch', 'region' => 'Jakarta'],
            ['name' => 'Surabaya Branch', 'region' => 'Surabaya'],
            ['name' => 'Bandung Branch', 'region' => 'Bandung'],
            ['name' => 'Medan Branch', 'region' => 'Medan'],
            ['name' => 'Yogyakarta', 'region' => 'DIY']
        ];

        foreach ($branches as $branch) {
            Branch::create($branch);
        }
    }
}