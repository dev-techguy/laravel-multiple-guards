<?php


namespace LaravelMultipleGuards;


use Illuminate\Support\ServiceProvider;

class LaravelMultipleGuardsServiceProvider extends ServiceProvider
{
    /**
     * ----------------------------------------------------
     * define the boot method and the register method here
     * ----------------------------------------------------
     * @return void
     */
    public function boot()
    {
        /**
         * ---------------------------
         * load configuration file
         * ---------------------------
         */
        $this->mergeConfigFrom(
            __DIR__ . '/config/laravel-multiple-guards.php', 'laravel-multiple-guards'
        );

        /**
         * ---------------------------
         * publishing the config file
         * ---------------------------
         */
        $this->publishes([
            __DIR__ . '/config/laravel-multiple-guards.php' => config_path('laravel-multiple-guards.php'),
        ], 'config');
    }

    /**
     * ------------------------------
     * Register here for any service
     * like the facades here
     * ------------------------------
     * @return void
     */
    public function register()
    {
        //
    }
}
