<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StylistSchedule;


class StylistScheduleSeeder extends Seeder
{

    public function run()
    {
        $stylists = \App\Models\Stylist::all();
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        foreach ($stylists as $stylist) {
            foreach ($days as $day) {
                // Skip Sunday for some stylists randomly
                if ($day === 'Sunday' && rand(0, 1) === 0) continue;

                StylistSchedule::create([
                    'stylist_id' => $stylist->id,
                    'day' => $day,
                    'start_time' => '09:00',
                    'end_time' => '18:00',
                ]);
            }
        }
    }
}
