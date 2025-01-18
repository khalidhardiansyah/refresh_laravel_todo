<?php

namespace App\Providers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
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
        // gate user dapat mengupdate todo
        Gate::define('update-todo', function(User $user, Todo $todo){
           return $user->id === $todo->user_id; 
        });
    }
}
