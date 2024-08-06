<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacion_productos', function (Blueprint $table) {
            $table->id();
            $table->integer('cotizacion_id');
            $table->integer('producto_id');
            $table->integer('nCantidad');
            $table->decimal('nPrecioUnitario', 10, 2);
            $table->decimal('nDescuento')->default(0);
            $table->tinyInteger('nEstado');
            $table->string('cUsuarioCreacion');
            $table->string('cUsuarioModificacion')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotizacion_productos');
    }
}
