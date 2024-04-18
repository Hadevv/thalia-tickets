<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistType extends Model
{
    use HasFactory;

    protected $table = 'artist_type';

    protected $fillable = [
        'artist_id',
        'type_id'
    ];

    public $timestamps = false;

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function shows()
    {
        return $this->belongsToMany(Show::class, 'artist_type_show', 'artist_type_id', 'show_id');
    }
    public function artistTypes()
    {
        return $this->belongsToMany(ArtistType::class);
    }
}



