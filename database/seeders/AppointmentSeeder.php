<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Stylist;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $customer = Customer::firstOrCreate(
            ['email' => 'completed.customer@example.com'],
            [
                'name' => 'Completed Customer',
                'contact_num' => '09171234567',
                'password' => bcrypt('password'),
            ]
        );

        $stylist = Stylist::query()->first();
        $service = Service::query()->first();

        if (! $stylist || ! $service) {
            return;
        }

        $appointmentDate = Carbon::now()->subDays(1)->setTime(10, 0, 0);

        $appointment = Appointment::firstOrCreate(
            [
                'customer_id' => $customer->id,
                'stylist_id' => $stylist->id,
                'appointment_datetime' => $appointmentDate,
            ],
            [
                'status' => 'done',
                'downpayment_amount' => $service->price,
            ]
        );

        $appointment->services()->sync([$service->id]);
    }
}
