<?php
namespace Kodarsiv\Modulity\Tests;

use Illuminate\Foundation\Testing\TestCase;

class ModulityTestCase extends TestCase
{
    public function createApplication()
    {
        $app = require __DIR__.'/../vendor/laravel/laravel/bootstrap/app.php';
        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
        return $app;
    }
}
