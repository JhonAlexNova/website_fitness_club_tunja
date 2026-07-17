<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Factura;
use App\Models\Pago;
use App\Observers\FacturaObserver;
use App\Observers\PagoObserver;

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
        date_default_timezone_set('America/Bogota');

        Factura::observe(FacturaObserver::class);
        Pago::observe(PagoObserver::class);
    }
}