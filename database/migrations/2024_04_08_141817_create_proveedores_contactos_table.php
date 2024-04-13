<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedoresContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores_contactos', function (Blueprint $table) {
            $table->id();
            $table->integer('proveedor_id');
            $table->string('cNombreCompleto');
            $table->string('cCelular')->nullable();
            $table->string('cCorreo')->nullable();
            $table->tinyInteger('nTipoDocumento')->nullable();
            $table->string('cNroDocumento')->nullable();
            $table->tinyInteger('nEstado')->default(1);
            $table->string('cUsuarioCreacion')->nullable();
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
        Schema::dropIfExists('proveedores_contactos');
    }
}
