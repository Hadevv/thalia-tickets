<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'seat_number',
        'status',
    ];

    public $timestamps = false;

    public function representation_reservations()
    {
        return $this->hasMany(RepresentationReservation::class);
    }
}
