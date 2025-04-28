<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            BranchesSeeder::class,          // First - no dependencies
            db_userSeeder::class,            // Depends on branches
            SupervisorSalesmanSeeder::class, // Depends on users
            CustomersSeeder::class,          // Depends on branches and users
            FollowUpsSeeder::class,         // Depends on customers and users
            HistoriesSeeder::class,          // Depends on users and branches
        ]);
    }
}