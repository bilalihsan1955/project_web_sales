<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;  // Add this line

class BranchesSeeder extends Seeder
{
    public function run()
    {
        $branches = [
            ['id' => 1, 'name' => 'TVBDG', 'region' => 'BANDENGAN'],
            ['id' => 2, 'name' => 'TVBKS', 'region' => 'BEKASI'],
            ['id' => 3, 'name' => 'TVBLP', 'region' => 'HARMONI'],
            ['id' => 4, 'name' => 'TVBTG', 'region' => 'BITUNG'],
            ['id' => 5, 'name' => 'TVBTL', 'region' => 'BATU TULIS'],
            ['id' => 6, 'name' => 'TVCLI', 'region' => 'CILEUNGSI'],
            ['id' => 7, 'name' => 'TVFWT', 'region' => 'FATMAWATI'],
            ['id' => 8, 'name' => 'TVKCI', 'region' => 'KARAWACI'],
            ['id' => 9, 'name' => 'TVKGV', 'region' => 'KELAPA GADING V'],
            ['id' => 10, 'name' => 'TVKJR', 'region' => 'KEBON JERUK'],
            ['id' => 11, 'name' => 'TVKLD', 'region' => 'KLENDER'],
            ['id' => 12, 'name' => 'TVKRW', 'region' => 'KARAWANG'],
            ['id' => 13, 'name' => 'TVMED', 'region' => 'KELAPA GADING VSP'],
            ['id' => 14, 'name' => 'TVPDG', 'region' => 'PONDOK GEDE'],
            ['id' => 15, 'name' => 'TVPDC', 'region' => 'PONDOK CABE'],
            ['id' => 16, 'name' => 'TVPIN', 'region' => 'PONDOK INDAH'],
            ['id' => 17, 'name' => 'TVTGR', 'region' => 'TANGERANG'],
            ['id' => 18, 'name' => 'TVYOS', 'region' => 'YOS SUDARSO'],
            ['id' => 19, 'name' => 'TRUST', 'region' => 'TRADE IN']
        ];

        foreach ($branches as $branch) {
            Branch::create($branch);
        }
    }
}