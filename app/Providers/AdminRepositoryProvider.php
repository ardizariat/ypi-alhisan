<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\{
    PengurusYayasanRepository,
    ArtikelRepository,
    RapatYayasanRepository,
};
use App\Repositories\Interface\{
    PengurusYayasanInterface,
    ArtikelInterface,
    RapatYayasanInterface,
};

class AdminRepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            PengurusYayasanInterface::class,
            PengurusYayasanRepository::class
        );
        $this->app->bind(
            RapatYayasanInterface::class,
            RapatYayasanRepository::class
        );
        $this->app->bind(
            ArtikelInterface::class,
            ArtikelRepository::class
        );
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
