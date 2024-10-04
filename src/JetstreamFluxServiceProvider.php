<?php

namespace Grpaiva\JetstreamFlux;

use Illuminate\Support\ServiceProvider;

class JetstreamFluxServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views'),
        ], 'jetstream-views');
    }

    public function register()
    {
        //
    }
}
