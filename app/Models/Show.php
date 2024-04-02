<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use HasFactory;


    protected $fillable = [
        'slug',
        'title',
        'poster_url',
        'duration',
        'created_in',
        'location_id',
        'bookable',
    ];

    protected $table = 'shows';

    public $timestamps = false;


    public function representations()
    {
        return $this->hasMany(Representation::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function artistTypes()
    {
        return $this->belongsToMany(ArtistType::class);
    }
}
