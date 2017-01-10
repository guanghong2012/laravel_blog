<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Navigation;//这个必须有，引入model，不然无法获取数据库数据
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $navitators = Navigation::orderBy('sort','desc')->get();
        view()->share('navitators', $navitators);
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
