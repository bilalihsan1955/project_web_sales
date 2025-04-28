<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FollowUp;
use Carbon\Carbon;

class FollowUpsSeeder extends Seeder
{
    public function run()
    {
        $customers = \DB::table('customers')->pluck('id');
        $salesmen = \DB::table('user')->where('role', 'salesman')->pluck('id');
        $statuses = ['pending', 'spk', 'rejected'];
        $channels = ['email', 'phone', 'whatsapp', 'visit'];

        for ($i = 1; $i <= 200; $i++) {
            $followDate = Carbon::now()->subDays(rand(0, 60));
            
            FollowUp::create([
                'customer_id' => $customers->random(),
                'salesman_id' => $salesmen->random(),
                'followup_date' => $followDate,
                'status' => $statuses[array_rand($statuses)],
                'channel' => $channels[array_rand($channels)],
                'notes' => fake()->sentence(),
                'created_at' => $followDate,
                'updated_at' => $followDate,
            ]);
        }
    }
}