<?php
# @Author: Codeals
# @Date:   04-08-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 04-08-2019
# @Copyright: Codeals

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
        Schema::defaultStringLength(191);
    }
}
