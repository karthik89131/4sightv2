<?php

namespace App\Providers;
use App\Project;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class ProjectServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Project::created(function ($event) {
            printf($event);
        });
    }
}
