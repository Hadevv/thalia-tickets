<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepresentationReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'representation_id',
        'locality_id',
        'quantity',
        'price_id'
    ];

    protected $table = 'representation_reservation';

    public $timestamps = false;

    public function representation()
    {
        return $this->belongsTo(Representation::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function price()
    {
        return $this->belongsTo(Price::class);
    }
}
