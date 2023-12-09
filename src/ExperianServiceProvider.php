<?php

namespace SamuelIrwin\Experian;

use Illuminate\Support\ServiceProvider;

class ExperianServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/ramci.php' => config_path('ramci.php'),
        ], 'ramci');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/ramci.php','ramci');

        $this->app->singleton('ExperianApi', function ($app){
            $config     =   $app->make('config');
            $username   =   $config->get('ramci.username');
            $password   =   $config->get('ramci.password');
            $serviceURL =   $config->get('ramci.serviceUrl');

            return new ExperianApi($username, $password, $serviceURL);

        });

        /*
        \App::bind('ExperianApi', function()
        {
           //return new \App\Helper\ramciAPI();
            return new \Baygroup\Experian\ExperianApi();
        });
        */
    }

    public function provides() {
        return ['ExperianApi'];
    }
}
