<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateVentasStoreProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS SP_GETALLVENTAS;');
        DB::unprepared('
            CREATE PROCEDURE SP_GETALLVENTAS(
                IN nEstado INT,
                IN cCorrelativo varchar(255),
                IN startDate DATE,
                IN endDate DATE
            )
            BEGIN 
                SELECT v.*, 
                    CONCAT(u.name, u.surname) as cNombreVendedor,
                      CONCAT( cli.cNombres, cli.cApellidos) as cNombreCliente
                FROM ventas v 
                LEFT JOIN users u ON u.id = v.vendedor_id
                LEFT JOIN clientes cli ON cli.id = v.cliente_id
                WHERE (nEstado = -1 OR v.nEstado = nEstado)
                  AND (cCorrelativo IS NULL OR v.cCorrelativo = cCorrelativo)
                  AND (startDate IS NULL OR v.dFechaVenta >= startDate)
                  AND (endDate IS NULL OR v.dFechaVenta <= DATE_ADD(endDate, INTERVAL 1 DAY));
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
        Schema::dropIfExists('ventas_store_procedure');
    }
}
