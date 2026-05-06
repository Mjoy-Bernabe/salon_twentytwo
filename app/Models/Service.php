<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_name',
        'description',
        'price',
        'is_promo',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_promo' => 'boolean',
    ];

    public function stylists()
    {
        return $this->belongsToMany(Stylist::class);
    }

    public function appointments()
    {
        return $this->belongsToMany(Appointment::class);
    }

    public function components()
    {
        return $this->belongsToMany(self::class, 'service_promo', 'promo_id', 'service_id');
    }

    public function promos()
    {
        return $this->belongsToMany(self::class, 'service_promo', 'service_id', 'promo_id');
    }
}
