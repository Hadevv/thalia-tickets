<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'admin',
        'member',
        'affiliate'
    ];

    protected $table = 'roles';

    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role');
    }
}
