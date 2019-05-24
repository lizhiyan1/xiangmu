<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;//必须的
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //数据库不是MySQL的 需要写个码
        Schema::defaultStringLength(191);//191
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
