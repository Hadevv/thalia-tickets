<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representation extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule',
        'location_id',
        'show_id'
    ];
    protected $table = 'representations';

    public $timestamps = false;

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function show()
    {
        return $this->belongsTo(Show::class);
    }
    public function representationReservations()
    {
        return $this->hasMany(RepresentationReservation::class);
    }

    

}
