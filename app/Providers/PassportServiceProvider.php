<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Connection;

/**
 * Class PassportServiceProvider
 * @package App\Providers
 */
class PassportServiceProvider extends ServiceProvider {
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $this->app->singleton(Connection::class, function() {
            return $this->app['db.connection'];
        });
    }
}