<?php

namespace Flashpoint\LaravelPrerender;

use Illuminate\Support\ServiceProvider;

class LaravelPrerenderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/prerender.php' => config_path('prerender.php')
        ], 'config');

        if (config('prerender.enable')) {
            $this->app['router']->pushMiddlewareToGroup('web', PrerenderMiddleware::class);
        }
    }

    /**
     * @inheritDoc
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/prerender.php', 'prerender');
    }
}
