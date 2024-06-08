<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->timestamp('dFechaEmision');
            $table->timestamp('dFechaExpiracion');
            $table->integer('nTotal');
            $table->text('cObservaciones');
            $table->integer('nEstadoCotizacion')->default(1);
            $table->integer('nTieneDescuento')->default(0);
            $table->integer('nDescuento');
            $table->tinyInteger('nEstado');
            $table->string('cUsuarioCreacion');
            $table->string('cUsuarioModificacion')->nullable();
            $table->integer('cliente_id');
            $table->integer('vendedor_id');
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
        Schema::dropIfExists('cotizaciones');
    }
}
