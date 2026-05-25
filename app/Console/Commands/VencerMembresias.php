<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserMembresia;
use Carbon\Carbon;

class VencerMembresias extends Command
{
    protected $signature = 'membresias:vencer';
    protected $description = 'Marca como expiradas las membresías vencidas';

    public function handle()
    {
        $actualizadas = UserMembresia::where('fecha_vencimiento', '<', Carbon::today())
            ->where('estado', '!=', 'expirada')
            ->update(['estado' => 'expirada']);

        $this->info("Membresías vencidas actualizadas: $actualizadas");
    }
}