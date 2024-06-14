<?php

namespace App\Providers;

use App\Employer\Employer;
use Illuminate\Support\ServiceProvider;

class EmployerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('employer',function(){
            return new Employer();
       });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
