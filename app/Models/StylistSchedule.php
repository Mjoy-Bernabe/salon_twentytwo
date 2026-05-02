<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StylistSchedule extends Model
{
        public function stylist() {
        return $this->belongsTo(Stylist::class);
    }
}
