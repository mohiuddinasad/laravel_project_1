<?php

namespace App\Providers;

use App\Models\Category\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('frontend.layout', function ($view) {
        $categories = Category::whereNull('category_id')
            ->with('children')
            ->get();

        $view->with('categories', $categories);
    });
    }
}
