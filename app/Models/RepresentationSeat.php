<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepresentationSeat extends Model
{
    use HasFactory;

    protected $fillable = [
        'representation_id',
        'seat_id',
        'status',
    ];

    protected $table = 'representation_seat';

    public function representation()
    {
        return $this->belongsTo(Representation::class);
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }

    public function reservations()
    {
        return $this->hasMany(RepresentationReservation::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available'); // verifier si le status est disponible
    }
}
