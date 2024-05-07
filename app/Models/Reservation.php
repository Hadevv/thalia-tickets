<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\StatusEnum;

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

    public function total()
    {
        $total = 0;
        foreach ($this->representation_reservations as $representation_reservation) {
            $total += $representation_reservation->price->price;
        }

        return $total;
    }

    public function status()
    {
        return StatusEnum::from($this->status)->label();
    }
}
