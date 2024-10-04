<?php

namespace Grpaiva\JetstreamFlux\Console\Commands;

use Illuminate\Console\Command;
use Exception;
use Grpaiva\JetstreamFlux\JetstreamFluxServiceProvider;

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
    protected function checkDependencies(): void
    {
        try {
            app(JetstreamFluxServiceProvider::class)->ensureDependenciesAreInstalled();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
