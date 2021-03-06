<?php

namespace GetThingsDone\Shareholder;

use GetThingsDone\Shareholder\Commands\ShareholderCommand;
use Illuminate\Support\ServiceProvider;

class ShareholderServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/shareholder.php' => config_path('shareholder.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/shareholder'),
            ], 'views');

            $migrationFileName = 'create_shareholder_table.php';
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
                ], 'migrations');
            }

            $this->commands([
                ShareholderCommand::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'shareholder');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/shareholder.php', 'shareholder');
    }

    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }
}
