<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CotizacionesStoreProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS SP_GETALLCOTIZACIONES;');
        DB::unprepared('
            CREATE PROCEDURE SP_GETALLCOTIZACIONES(
                IN nEstado INT,
                IN cCorrelativo varchar(255),
                IN startDate DATE,
                IN endDate DATE
            )
            BEGIN 
                SELECT c.*, 
                    CONCAT(u.name, u.surname) as cNombreVendedor,
                      CONCAT( cli.cNombres, cli.cApellidos) as cNombreCliente
                FROM cotizaciones c 
                LEFT JOIN users u ON u.id = c.vendedor_id
                LEFT JOIN clientes cli ON cli.id = c.cliente_id
                WHERE (nEstado = -1 OR c.nEstado = nEstado)
                  AND (cCorrelativo IS NULL OR c.cCorrelativo = cCorrelativo)
                  AND (startDate IS NULL OR c.dFechaEmision >= startDate)
                  AND (endDate IS NULL OR c.dFechaEmision <= endDate);
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotizaciones_store_procedure');
    }
}
