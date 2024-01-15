<?php

namespace App\Providers;

use App\Models\Support;
use App\Observers\SupportObserver;

use App\Repositories\Contracts\ReplyRepositoryInterface as ContractsReplyRepositoryInterface;
use App\Repositories\Contracts\SupportRepositoryInterface as ContractsSupportRepositoryInterface;

use App\Repositories\Eloquent\ReplySupportORM;
use App\Repositories\SupportEloquentORM;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            ContractsSupportRepositoryInterface::class,
            SupportEloquentORM::class
        );

        $this->app->bind(
            ContractsReplyRepositoryInterface::class,
            ReplySupportORM::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Support::observe(SupportObserver::class);
    }
}
