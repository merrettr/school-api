<?php

namespace App\Providers;

use Illuminate\Mail\MailServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register () {
        $this->app->register(MailServiceProvider::class);
        $this->app->configure('mail');
    }
}
