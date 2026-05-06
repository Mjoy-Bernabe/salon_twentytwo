<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'stylist_id',
        'appointment_datetime',
        'status',
        'downpayment_amount',
    ];

    protected $casts = [
        'appointment_datetime' => 'datetime',
        'downpayment_amount' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function stylist()
    {
        return $this->belongsTo(Stylist::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
