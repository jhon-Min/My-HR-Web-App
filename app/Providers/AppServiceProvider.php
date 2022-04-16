<?php

namespace App\Providers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        // View Share
        if(Schema::hasTable('departments')){
            View::share('departments', Department::orderBy('name')->get());
        }


    }
}
