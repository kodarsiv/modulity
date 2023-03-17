<?php

namespace Kodarsiv\Modulity\Providers;

use Illuminate\Support\ServiceProvider;
use Kodarsiv\Modulity\Commands\StructureGenerator;
use Kodarsiv\Modulity\Modulity;

class ModulityServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()){
            // publish config
            $this->publishes([
                __DIR__."/../config/modulity.php" => config_path("modulity.php")
            ], "modulity-config");

            // commands entegration
            $this->commands([
                StructureGenerator::class
            ]);
        }
    }

        /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    	$this->app->bind('Modulity', function (){
    	    return new Modulity();
        });
    }
}
