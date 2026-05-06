<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StylistSchedule;


class StylistScheduleSeeder extends Seeder
{
    
    public function run()
    {
        StylistSchedule::create([
            'stylist_id' => 1,
            'day' => 'Monday'
        ]);

        StylistSchedule::create([
            'stylist_id' => 1,
            'day' => 'Wednesday'
        ]);
    }
}
