<?php

namespace Aqayepardakht\Handy;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Migrations\MigrationRepositoryInterface;

class AqayepardakhtServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->handleConfig();
            $this->handleMigrations();
        }
    }

    public function register() 
    {
        \App::bind('WalletService', function(){
            return new \Aqayepardakht\Handy\Wallet\WalletService;
        });
    }

    private function handleConfig(): void
    {
        $configPath = __DIR__ . '/../config/config.php';

        $this->publishes([$configPath => config_path('Handy.php')]);

        $this->mergeConfigFrom($configPath, 'Handy');

    }

    private function handleMigrations(): void
    {
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../database/seeders' => database_path('seeders'),
        ], 'seeders');
    }

    protected function getMigrationFiles($path)
    {
        $files = [];

        foreach (glob($path . '/*.php') as $file) {
            $fileName = basename($file);
            $className = "Aqayepardakht\\Handy\\Database\\Migrations\\" . str_replace('.php', '', $fileName);

            $files[$fileName] = $className;
        }

        return $files;
    }
}