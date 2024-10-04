<?php

namespace Grpaiva\JetstreamFlux;

use Exception;
use Flux\Flux;
use Grpaiva\JetstreamFlux\Console\Commands\PublishJetstreamFluxViews;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
use Livewire\Livewire;

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

    /**
     * @throws Exception
     */
    public function ensureDependenciesAreInstalled(): void
    {
        if (!class_exists(Application::class)) {
            throw new \Exception('Laravel Framework is not installed.');
        }

        if (!class_exists(Jetstream::class)) {
            throw new \Exception('Laravel Jetstream is not installed.');
        }

        if (!class_exists(Livewire::class)) {
            throw new \Exception('Livewire is not installed.');
        }

        if (!class_exists(Flux::class)) {
            throw new \Exception('Flux is not installed.');
        }
    }
}
