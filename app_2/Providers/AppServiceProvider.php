<?php

namespace App\Providers;

use App\Domain\Access\User\Models\User;
use App\Domain\Access\User\Observers\UserObserver;
use Domain\Import\Interfaces\CatalogRepository;
use Domain\Import\Repositories\CatalogLocalRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
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
        $this->app->bind(CatalogRepository::class, CatalogLocalRepository::class);
        ResourceCollection::withoutWrapping();
        JsonResource::withoutWrapping();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
    }
}
