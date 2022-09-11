<?php

namespace App\Providers;

use App\Models\Lesson;
use App\Observers\LessonObserver;
use App\Repositories\UserRepository;
use App\Repositories\AdminRepository;
use App\Repositories\CourseRepository;
use App\Repositories\ModuleRepository;
use App\Repositories\LessonRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\SupportRepository;
use App\Repositories\SupportReplyRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\AdminRepositoryInterface;
use App\Repositories\Contracts\CourseRepositoryInterface;
use App\Repositories\Contracts\LessonRepositoryInterface;
use App\Repositories\Contracts\ModuleRepositoryInterface;
use App\Repositories\Contracts\SupportRepositoryInterface;
use App\Repositories\Contracts\SupportReplyRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
        $this->app->bind(
            AdminRepositoryInterface::class,
            AdminRepository::class
        );
        $this->app->bind(
            CourseRepositoryInterface::class,
            CourseRepository::class
        );
        $this->app->bind(
            ModuleRepositoryInterface::class,
            ModuleRepository::class
        );
        $this->app->bind(
            LessonRepositoryInterface::class,
            LessonRepository::class
        );
        $this->app->bind(
            SupportRepositoryInterface::class,
            SupportRepository::class
        );
        $this->app->bind(
            SupportReplyRepositoryInterface::class,
            SupportReplyRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Lesson::observe(LessonObserver::class);
    }
}
