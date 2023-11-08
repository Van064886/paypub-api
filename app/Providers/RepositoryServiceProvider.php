<?php

namespace App\Providers;

use App\Core\Advertisements\Repositories\AdvertisementsRepository;
use App\Core\Advertisements\Repositories\Interfaces\AdvertisementsRepositoryInterface;
use App\Core\Enterprises\Repositories\EnterpriseRepository;
use App\Core\Enterprises\Repositories\Interfaces\EnterpriseRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Core\Users\Repositories\UserRepository;
use App\Core\Users\Repositories\Interfaces\UserRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @var array $models
     */
    protected $models =
    [
        [UserRepositoryInterface::class, UserRepository::class],
        [EnterpriseRepositoryInterface::class, EnterpriseRepository::class],
        [AdvertisementsRepositoryInterface::class, AdvertisementsRepository::class],
    ];

    /**
     * Function to bind the repositories
     */
    public function bindRepositories(): void
    {
        foreach ($this->models as $model) {
            $this->app->bind($model[0], $model[1]);
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->bindRepositories();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
