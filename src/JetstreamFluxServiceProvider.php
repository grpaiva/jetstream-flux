<?php

namespace Grpaiva\JetstreamFlux;

use Exception;
use Flux\Flux;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
use Livewire\Livewire;

class JetstreamFluxServiceProvider extends ServiceProvider
{
    /**
     * @throws Exception
     */
    public function boot(): void
    {
        try {
            $this->ensureDependenciesAreInstalled();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views'),
        ], 'jetstream-flux');
    }

    protected function ensureDependenciesAreInstalled(): void
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

    public function register()
    {
        //
    }
}
