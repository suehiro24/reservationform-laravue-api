<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use RsvForm\Domain\Repositories\ICourseRepository;
use RsvForm\Infrastructure\Repositories\CourseRepository;

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
        $this->app->bind(ICourseRepository::class, CourseRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
