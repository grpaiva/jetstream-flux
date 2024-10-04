<?php

namespace Grpaiva\JetstreamFlux;

use Grpaiva\JetstreamFlux\Console\Commands\PublishJetstreamFluxViews;
use Illuminate\Support\ServiceProvider;

class JetstreamFluxServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        $this->registerViewPublishing();
    }

    public function register(): void
    {
        $this->commands([
            PublishJetstreamFluxViews::class,
        ]);
    }

    protected function registerViewPublishing(): void
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/jetstream-flux'),
        ], 'jetstream-flux');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views'),
        ], 'jetstream-views-replace');
    }
}
