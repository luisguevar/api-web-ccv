<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        

        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('cDescripcion');
            $table->integer('categoria_id');
            $table->integer('proveedor_id');
            $table->string('cSlug');
            $table->string('cSku');
            $table->decimal('nPrecioPEN', 10, 2);
            $table->decimal('nPrecioUSD', 10, 2);
            $table->text('cResumen');
            $table->text('cDescripcionDetallada');
            $table->string('cImagen')->nullable();
            $table->integer('nStock');
            $table->decimal('nPrecioCompra', 10, 2);
            $table->date('dFechaCompra');
            $table->string('cUsuarioCreacion');
            $table->string('cUsuarioModificacion')->nullable();
            $table->tinyInteger('nEstado')->default(1); 
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
        Schema::dropIfExists('productos');
    }
}
