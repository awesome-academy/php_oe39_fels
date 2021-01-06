<?php

namespace App\Providers;

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
        $this->app->singleton(
            \App\Repositories\User\Profile\ProfileRepositoryInterface::class,
            \App\Repositories\User\Profile\ProfileRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\User\Course\CourseRepositoryInterface::class,
            \App\Repositories\User\Course\CourseRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\User\Lesson\LessonRepositoryInterface::class,
            \App\Repositories\User\Lesson\LessonRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\User\Answer\AnswerRepositoryInterface::class,
            \App\Repositories\User\Answer\AnswerRepository::class,
        );

        $this->app->singleton(
            \App\Repositories\User\Word\WordRepositoryInterface::class,
            \App\Repositories\User\Word\WordRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view) {
            $view->with('userss', auth()->user());
        });

    }
}
