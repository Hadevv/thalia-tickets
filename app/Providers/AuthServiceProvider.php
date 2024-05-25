<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Tag;
use App\Policies\TagPolicy;
use App\Models\User;
use App\Policies\AdminPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => AdminPolicy::class,
        Tag::class => TagPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
