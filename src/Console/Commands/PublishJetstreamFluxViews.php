<?php

namespace Grpaiva\JetstreamFlux\Console\Commands;

use Flux\Flux;
use Illuminate\Console\Command;
use Exception;
use Grpaiva\JetstreamFlux\JetstreamFluxServiceProvider;
use Illuminate\Foundation\Application;
use Laravel\Jetstream\Jetstream;
use Livewire\Livewire;

class PublishJetstreamFluxViews extends Command
{
    protected $signature = 'jetstream-flux:publish {--mode=vendor : The mode for publishing the views (vendor|replace)}';

    protected $description = 'Publish Jetstream Flux views with an option to replace or install in vendor mode.';

    public function handle()
    {
        try {
            $this->checkDependencies();

            $mode = $this->option('mode');

            if ($mode === 'replace') {
                $this->call('vendor:publish', [
                    '--tag' => 'jetstream-views-replace',
                    '--force' => true,
                ]);
                $this->info('Jetstream Flux views have been published and replaced in the /resources/views directory.');
            } else {
                $this->call('vendor:publish', [
                    '--tag' => 'jetstream-flux',
                ]);
                $this->info('Jetstream Flux views have been published to /resources/views/vendor/jetstream-flux.');
            }
        } catch (Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function checkDependencies(): void
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
