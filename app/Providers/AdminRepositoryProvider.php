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
};
use App\Repositories\Interface\{
    PengurusYayasanInterface,
    ArtikelInterface,
    RapatYayasanInterface,
    KalimatHikmahInterface,
    KasMasukInterface,
    KasKeluarInterface,
    UserInterface,
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
