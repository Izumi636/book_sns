<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\User;
use App\Models\Review;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
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
        Paginator::useBootstrap();

        $userCount = User::count();
        View::share('userCount', $userCount);

        $reviewCount = Review::count();
        View::share('reviewCount', $reviewCount);

        $bookCount = Book::count();
        View::share('bookCount', $bookCount);

        // Gates are simply closures that determine if a user is authorized to perform a given action
        Gate::define('admin', function($user){
             return $user->role_id === 1;
             // User::ADMIN_ROLE_ID;
         });
    }
}
