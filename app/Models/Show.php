<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'slug',
        'title',
        'poster_url',
        'bookable',
        'price',
        'description',
        'created_at',
    ];

    protected $table = 'shows';

    public $timestamps = false;

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'artist_type_show', 'show_id', 'artist_id');
    }
}

