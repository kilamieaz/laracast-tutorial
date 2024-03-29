<?php

namespace App\Providers;

use App\Project;
use App\Observers\ProjectObserver;
use App\Observers\TaskObserver;
use App\Task;
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
        // Project::observe(ProjectObserver::class);
        // Task::observe(TaskObserver::class);
        Schema::defaultStringLength(191);
    }
}
