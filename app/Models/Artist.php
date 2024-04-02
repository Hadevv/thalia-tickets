<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
    ];

    protected $table = 'artists';

    public $timestamps = false;

    public function types() : BelongsToMany
    {
        return $this->belongsToMany(Type::class);
    }
    public function artistTypes()
    {
        return $this->hasMany(ArtistType::class);
    }
}
