<?php

namespace App\Providers;
use Laravel\Fortify\Fortify;
use App\Actions\Fortify\CreateNewUser;


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
        //
    }

    protected $policies = [
        \App\Models\Subject::class => \App\Policies\SubjectPolicy::class,
        // you can add Task and Solution policies here later
    ];
}
