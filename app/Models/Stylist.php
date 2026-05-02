<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stylist extends Model
{
        public function services() {
        return $this->belongsToMany(Service::class);
    }

    public function schedules() {
        return $this->hasMany(StylistSchedule::class);
    }

    public function appointments() {
        return $this->hasMany(Appointment::class);
    }
}
