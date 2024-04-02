<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'locality_id',
        'designation',
        'address',
        'website',
        'phone',
    ];

    protected $table = 'locations';

    public $timestamps = false;

    public function locality()
    {
        return $this->belongsTo(Locality::class);
    }

    public function shows()
    {
        return $this->hasMany(Show::class);
    }
    public function representations()
    {
        return $this->hasMany(Representation::class);
    }
}
