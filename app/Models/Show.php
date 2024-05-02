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
        'description',
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
        return $this->belongsToMany(ArtistType::class, 'artist_type_show', 'artist_type_id', 'show_id');
    }
    public function authors()
    {
        return $this->artistTypes()
            ->whereHas('type', function ($query) {
                $query->where('type', 'auteur');
            })
            ->with('artist')
            ->get()
            ->pluck('artist')
            ->unique('id');
    }
    public function actors()
    {
        return $this->artistTypes()
            ->whereHas('type', function ($query) {
                $query->where('type', 'comédien');
            })
            ->with('artist')
            ->get()
            ->pluck('artist');
    }
    // API
    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'artist_type_show', 'show_id', 'artist_type_id')
            ->withPivot('id')
            ->with('artistTypes.type');
    }

    public function types()
    {
        return $this->belongsToMany(Type::class, 'artist_type_show', 'show_id', 'artist_type_id')
            ->withPivot('id')
            ->with('artistTypes.artist');
    }

    public static function search($query)
    {
        return self::where('title', 'like', "%$query%");
    }
}
