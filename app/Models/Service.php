<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
        public function stylists() {
        return $this->belongsToMany(Stylist::class);
    }

    public function appointments() {
        return $this->belongsToMany(Appointment::class);
    }
}
