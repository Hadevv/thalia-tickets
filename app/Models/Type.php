<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    protected $table = 'types';

    public $timestamps = false;

    public function artists() : BelongsToMany
    {
        return $this->belongsToMany(Artist::class);
    }
}



