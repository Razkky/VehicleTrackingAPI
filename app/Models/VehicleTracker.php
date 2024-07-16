<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleTracker extends Model
{
    use HasFactory;

    protected $fillable = [
        'manufacturer',
        'model',
        'year',
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function locations() {
        return $this->hasMany(Location::class);
    }
}
