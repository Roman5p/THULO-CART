<?php

namespace App\Providers;

use App\Models\Cart;
// use Auth;
use Illuminate\Support\Facades;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Facades\View::composer('*', function (View $view) {
            if (auth()->check()) {
                $item = Cart::where('user_id', auth()->id())->get();
            } else {
                $carts = null;
            }
            // $view->with('carts', $item);
        });
    }
}
