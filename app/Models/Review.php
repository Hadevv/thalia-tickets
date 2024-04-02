<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'review',
        'stars',
        'created_at',
        'updated_at',
        'validated',
        'user_id',
        'show_id'
    ];

    protected $table = 'reviews';

    public $timestamps = false;


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function show()
    {
        return $this->belongsTo(Show::class);
    }
}
