<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 在 Laravel 5.4 及以下版本，使用 Schema::defaultStringLength 方法
    Schema::defaultStringLength(191);

    // 或者在 Laravel 5.5 及更高版本，使用 Schema::defaultStringLength 方法的别名
    \Illuminate\Database\Schema\Builder::defaultStringLength(191);
    }
}
