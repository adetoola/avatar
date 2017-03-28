<?php

namespace Adetoola\Avatar;

use Illuminate\Support\ServiceProvider;;

class AvatarServiceprovider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        // create avatar
        $this->app->singleton('avatar', function ($app) {
            return new Avatar($app);
        });

        $this->app->alias('avatar', 'Adetoola\Avatar');
    }
}
