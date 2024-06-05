<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\RoleEnum;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Billable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'login',
        'firstname',
        'lastname',
        'email',
        'password',
        'langue',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin()
    {
        return $this->roles()->where('role', RoleEnum::ADMIN)->exists();
    }

    public function isMember()
    {
        return $this->roles()->where('role', RoleEnum::MEMBER)->exists();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function representations()
    {
        return $this->hasMany(Representation::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favoriteShows()
    {
        return $this->belongsToMany(Show::class, 'favorites')->withPivot('user_id', 'show_id');
    }

    public function likedShows()
    {
        return $this->belongsToMany(Show::class, 'likes')->withPivot('user_id', 'show_id');
    }
}
