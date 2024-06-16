<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductsStoreProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS SP_GETALLPRODUCTS;');
        DB::unprepared('
            CREATE PROCEDURE SP_GETALLPRODUCTS(
                IN nEstado INT,
                IN categoria_id INT,
                IN nTipoStock INT,
                IN startDate DATE,
                IN endDate DATE
            )
            BEGIN 
                SELECT p.*, 
                       c.cDescripcion as cNombreCategoria
                FROM productos p 
                INNER JOIN categorias c ON c.id = p.categoria_id
                WHERE (nEstado = -1 OR p.nEstado = nEstado)
                  AND (categoria_id = 0 OR p.categoria_id = categoria_id)
                  AND (nTipoStock = -1 OR (nTipoStock = 1 AND p.nStock > 0) OR (nTipoStock = 0 AND p.nStock = 0))
                  AND (startDate IS NULL OR p.dFechaCompra >= startDate)
                  AND (endDate IS NULL OR p.dFechaCompra <= endDate);
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
        Schema::dropIfExists('products_store_procedure');
    }
}
