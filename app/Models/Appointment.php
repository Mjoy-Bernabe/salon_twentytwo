<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
        public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function stylist() {
        return $this->belongsTo(Stylist::class);
    }

    public function services() {
        return $this->belongsToMany(Service::class);
    }
    protected $fillable = [
        'customer_id',
        'stylist_id',
        'appointment_datetime',
        'status',
        'downpayment_amount'
    ];

   
}
