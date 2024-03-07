<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        view()->composer('*', function($view){  // nó sẽ được gọi mỗi khi view được render. , * render all (để call data to home page)
            $cats_home = Category::orderBy('name', 'ASC')->where('status', 1)->get();
            $carts = Cart::where('customer_id', auth('cus')->id())->get();
            $view->with(compact('cats_home', 'carts'));
        });
    }
}
