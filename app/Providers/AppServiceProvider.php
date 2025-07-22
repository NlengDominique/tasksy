<?php

namespace App\Providers;

use App\Models\Task;
use App\Models\User;
use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;
use Illuminate\Http\Request;
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
        Gate::define('update-profile', function (User $authUser, User $profileUser) {
            return $authUser->id === $profileUser->id;
        });

        Gate::define('update-task', function (User $user, Task $task){
            return $user->id === $task->user_id;
        });
        Gate::define('delete-task', function (User $user, Task $task){
            return $user->id === $task->user_id;
        });

        Gate::define('update-task-status', function (User $user, Task $task){
            return $user->id === $task->user_id;
        });

        Scramble::configure()
            ->withDocumentTransformers(function (OpenApi $openApi) {
                $openApi->secure(
                    SecurityScheme::http('bearer')
                );
            });


    }
}
