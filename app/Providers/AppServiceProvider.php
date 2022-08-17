<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Register\RegisterRepository::class,
            \App\Repositories\Register\RegisterEloquent::class
        );
        $this->app->singleton(
            \App\Repositories\Login\LoginRepository::class,
            \App\Repositories\Login\LoginEloquent::class
        );
        $this->app->singleton(
            \App\Repositories\Member\MemberRepository::class,
            \App\Repositories\Member\MemberEloquent::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       
    }
}
