<?php

namespace Aqayepardakht\Handy\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Contracts\Config\Repository;
use function Orchestra\Testbench\artisan;

use Aqayepardakht\Handy\AqayepardakhtServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
      parent::setUp();
    }

  protected function getPackageProviders($app)
  {
    return [
        AqayepardakhtServiceProvider::class,
    ];
  }

  protected function defineDatabaseMigrations()
  {
    $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

    artisan($this, 'migrate');

    $this->beforeApplicationDestroyed(
        fn () => artisan($this, 'migrate:rollback')
    );
  }

  // protected function defineEnvironment($app)
  // {
  //   tap($app->make('config'), function (Repository $config) {
  //       $config->set('database.default', 'testbench');
  //       $config->set('database.connections.testbench', [
  //           'driver'   => 'sqlite',
  //           'database' => ':memory:',
  //           'prefix'   => '',
  //       ]);
        
  //       $config([
  //           'queue.batching.database' => 'testbench',
  //           'queue.failed.database' => 'testbench',
  //       ]);
  //   });
  // }
}