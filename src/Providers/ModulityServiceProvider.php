<?php

namespace Kodarsiv\Modulity\Providers;

use Illuminate\Support\ServiceProvider;
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