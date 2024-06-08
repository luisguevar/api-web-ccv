<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CotizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cotizaciones')->insert([
            [
                'dFechaEmision' => Carbon::now(),
                'dFechaExpiracion' => Carbon::now()->addDays(30),
                'nTotal' => 10000,
                'cObservaciones' => 'Primera cotización',
                'nEstadoCotizacion' => 1,
                'nTieneDescuento' => 0,
                'nDescuento' => 0,
                'nEstado' => 1,
                'cUsuarioCreacion' => '74757790',
                'cUsuarioModificacion' => '74757790',
                'cliente_id' => 1,
                'vendedor_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'dFechaEmision' => Carbon::now(),
                'dFechaExpiracion' => Carbon::now()->addDays(30),
                'nTotal' => 20000,
                'cObservaciones' => 'Segunda cotización',
                'nEstadoCotizacion' => 2,
                'nTieneDescuento' => 0,
                'nDescuento' => 0,
                'nEstado' => 1,
                'cUsuarioCreacion' => '74757790',
                'cUsuarioModificacion' => '74757790',
                'cliente_id' => 1,
                'vendedor_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'dFechaEmision' => Carbon::now(),
                'dFechaExpiracion' => Carbon::now()->addDays(30),
                'nTotal' => 15000,
                'cObservaciones' => 'Tercera cotización',
                'nEstadoCotizacion' => 3,
                'nTieneDescuento' => 0,
                'nDescuento' => 0,
                'nEstado' => 1,
                'cUsuarioCreacion' => '74757790',
                'cUsuarioModificacion' => '74757790',
                'cliente_id' => 1,
                'vendedor_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
