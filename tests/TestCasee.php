<?php

namespace Aqayepardakht\Handy\Tests;

use Aqayepardakht\Handy\AqayepardakhtServiceProvider;
use Orchestra\Testbench\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;

class TestCasee extends TestCase
{
    // protected $enablesPackageDiscoveries = true;
    // use RefreshDatabase;


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

  protected function getEnvironmentSetUp($app)
  {
    // perform environment setup
  }
}