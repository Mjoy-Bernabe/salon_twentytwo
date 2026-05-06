<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StylistSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'stylist_id',
        'day',
        'start_time',
        'end_time',
    ];

    public function stylist()
    {
        return $this->belongsTo(Stylist::class);
    }
}
