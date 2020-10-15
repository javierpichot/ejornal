<?php

namespace App\Providers;

use App\Models\RevisionPeriodicaEntidad;
use App\Models\Tarea;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use OwenIt\Auditing\Models\Audit;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        setlocale(LC_TIME, 'es_ES.UTF-8');
        Carbon::setLocale('es');
    }

    protected  function porcentaje($cantidad,$porciento,$decimales){
        return number_format($cantidad*$porciento/100 ,$decimales);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {

        }
    }
}
