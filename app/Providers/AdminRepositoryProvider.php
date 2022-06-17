<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\{
    PengurusYayasanRepository,
    ArtikelRepository,
    RapatYayasanRepository,
    KalimatHikmahRepository,
    KasMasukRepository,
    KasKeluarRepository,
    UserRepository,
    GaleriRepository
};
use App\Repositories\Interface\{
    PengurusYayasanInterface,
    ArtikelInterface,
    RapatYayasanInterface,
    KalimatHikmahInterface,
    KasMasukInterface,
    KasKeluarInterface,
    UserInterface,
    GaleriInterface,
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
            GaleriInterface::class,
            GaleriRepository::class
        );
        $this->app->bind(
            UserInterface::class,
            UserRepository::class
        );
        $this->app->bind(
            KasKeluarInterface::class,
            KasKeluarRepository::class
        );
        $this->app->bind(
            KasMasukInterface::class,
            KasMasukRepository::class
        );
        $this->app->bind(
            KalimatHikmahInterface::class,
            KalimatHikmahRepository::class
        );
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
