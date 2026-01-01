<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\TransactionHeader;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\FnB;
use App\Models\Pusat;
use App\Policies\UserPolicy;
use App\Policies\TransactionPolicy;
use App\Policies\ProvinsiPolicy;
use App\Policies\KotaPolicy;
use App\Policies\FnbPolicy;
use App\Policies\PusatPolicy;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        User::class => UserPolicy::class,
        TransactionHeader::class => TransactionPolicy::class,
        Provinsi::class => ProvinsiPolicy::class,
        Kota::class => KotaPolicy::class,
        FnB::class => FnbPolicy::class,
        Pusat::class => PusatPolicy::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('isSuperAdmin', function ($user) {
            return $user->role === 'superadmin';
        });

        Gate::define('isStaff', function ($user) {
            return $user->role === 'staff';
        });
    }
}
