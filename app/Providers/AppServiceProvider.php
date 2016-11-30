<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;//这个必须有，引入model，不然无法获取数据库数据
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
        $allcategorys = Category::orderBy('sort','desc')->get();
        view()->share('allcategorys', $allcategorys);
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
