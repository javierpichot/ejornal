<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['adminlte::layouts.app', '*'], 'App\ViewComposers\TicketsComposer');
        View::composer(['adminlte::layouts.app', '*'], 'App\ViewComposers\TareasComposer');
        View::composer(['adminlte::layouts.app', '*'], 'App\ViewComposers\ImapComposer');

       View::composer(['adminlte::layouts.vue', '*'], 'App\ViewComposers\TicketsComposer');
       View::composer(['adminlte::layouts.vue', '*'], 'App\ViewComposers\TareasComposer');
       View::composer([
           'adminlte::layouts.vue',
           '*'
       ], 'App\ViewComposers\AusenteComposer');

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
