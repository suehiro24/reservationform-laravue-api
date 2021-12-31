<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;
use RsvForm\Domain\Repositories\IApptSlotRepository;
use RsvForm\Domain\Repositories\ICourseRepository;
use RsvForm\Infrastructure\Repositories\ApptSlotRepository;
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
        $this->app->bind(ICourseRepository::class, CourseRepository::class);
        $this->app->bind(IApptSlotRepository::class, ApptSlotRepository::class);
        // For Laravel Sanctum
        // See: https://readouble.com/laravel/8.x/ja/sanctum.html#migration-customization
        Sanctum::ignoreMigrations();
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
