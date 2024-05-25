<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Show;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag',
    ];

    protected $table = 'tags';

    public $timestamps = false;

    public function shows(): BelongsToMany
    {
        return $this->belongsToMany(Show::class);
    }
}
