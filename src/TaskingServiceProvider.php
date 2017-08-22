<?php

namespace Story\Tasking;

use Creativeorange\Gravatar\GravatarServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class TaskingServiceProvider extends ServiceProvider
{
    use EventMap, ServiceBindings;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerEvents();
        $this->registerRoutes();
        $this->registerResources();
        $this->registerMigrations();
        $this->defineAssetPublishing();
    }

    /**
     * Register the Story Job event.
     *
     * @return void
     */
    protected function registerEvents()
    {
        $events = $this->app->make(Dispatcher::class);

        foreach ($this->events as $event => $listeners) {
            foreach ($listeners  as $listener) {
                $events->listen($event, $listener);
            }
        }
    }

    /**
     * Register the Tasking routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::group([
            'prefix' => 'tasking',
            'namespace' => 'Story\Tasking\Http\Controllers',
            'middleware' => 'web'
        ], function() {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    /**
     * Register the Tasking resources.
     *
     * @return void
     */
    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tasking');
    }

    /**
     * Register mirations database schema
     *
     * @return void
     */
    protected function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

     /**
     * Define the asset publishing configuration.
     *
     * @return void
     */
    public function defineAssetPublishing()
    {
        $this->publishes([ TASKING_PATH.'/public' => public_path('vendor/tasking') ], 'tasking-assets');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (! defined('TASKING_PATH')) {
            define('TASKING_PATH', realpath(__DIR__.'/../'));
        }

        $this->configure();
        $this->registerServices();
    }

    /**
     * Setup the configuration for Tasking.
     *
     * @return void
     */
    protected function configure()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/tasking.php', 'tasking');
        $this->mergeConfigFrom(__DIR__.'/../config/gravatar.php', 'gravatar');
    }

    /**
     * Register Tasking's services in the container.
     *
     * @return void
     */
    protected function registerServices()
    {
        $this->app->register(GravatarServiceProvider::class);

        foreach ($this->bindings as $key => $value) {
            is_numeric($key) ? $this->app->singleton($value) : $this->app->singleton($key, $value);
        }
    }
}
