<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'seat_number',
    ];

    public $timestamps = false;

    public function representation_reservations()
    {
        return $this->hasMany(RepresentationReservation::class);
    }
    // seats can be associated with many representations
    public function representations()
    {
        return $this->belongsToMany(Representation::class, 'representation_seat')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    public function reservations()
    {
        return $this->hasManyThrough(Reservation::class, RepresentationSeat::class, 'seat_id', 'id', 'id', 'representation_seat_id');
    }
}
