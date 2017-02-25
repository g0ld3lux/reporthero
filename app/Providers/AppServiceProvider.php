<?php

namespace Reporthero\Providers;

use Illuminate\Support\ServiceProvider;
use Bouncer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Bouncer::cache();
        Bouncer::seeder(function () {
        Bouncer::allow('admin')->to(['ban-users', 'add-users', 'delete-users', 'view-users', 'edit-users']);
        Bouncer::allow('users')->to('update-profile');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
