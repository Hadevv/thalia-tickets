<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepresentationArchive extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule',
        'location_id',
        'show_id'
    ];

    protected $table = 'representation_archives';

    public $timestamps = true;

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function show()
    {
        return $this->belongsTo(Show::class);
    }
}
