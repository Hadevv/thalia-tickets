<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        return $this->roles->contains('admin');
    }

    public function isMember()
    {
        return $this->roles->contains('member');
    }

    public function isAffiliate()
    {
        return $this->roles->contains('affiliate');
    }

    public function isRole($role)
    {
        return $this->roles->contains($role);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function representations()
    {
        return $this->hasMany(Representation::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
