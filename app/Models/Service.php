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
        'estimated_time',
        'is_promo',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'estimated_time' => 'integer',
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
        return $this->belongsToMany(self::class, 'service_promo', 'promo_id', 'service_id')
            ->withPivot(['estimated_time', 'price']);
    }

    public function promos()
    {
        return $this->belongsToMany(self::class, 'service_promo', 'service_id', 'promo_id')
            ->withPivot(['estimated_time', 'price']);
    }
}
