<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'booking_date',
        'status',
    ];

    protected $table = 'reservations';

    public $timestamps = false;

    public function representation_reservations()
    {
        return $this->hasMany(RepresentationReservation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
