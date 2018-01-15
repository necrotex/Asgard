<?php

namespace Asgard\Providers;

use Conduit\Conduit;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Cache\Repository;
use Madewithlove\IlluminatePsrCacheBridge\Laravel\CacheItemPool;
use Psr\Cache\CacheItemPoolInterface;

class EsiClientServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // prepare ps6 -> laravel cache bridge
        $this->app->singleton(CacheItemPoolInterface::class, function ($app) {
            $repository = $app->make(Repository::class);

            return new CacheItemPool($repository);
        });


        $this->app->bind(Conduit::class, function ($app) {
            $conduit = new Conduit();
            $conduit->getConfiguration()->setCache($app->make(CacheItemPool::class));

            return $conduit;
        });
    }
}
