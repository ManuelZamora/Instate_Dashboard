<?php

namespace App\Providers;
use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Carbon\Language::all()['es'];
        Carbon::setLocale('es');
        \Carbon\Translator::get('es_MX');
        Carbon::setUTF8(true);
        setlocale(LC_TIME, 'es');
    }
}
