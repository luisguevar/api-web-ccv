<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('cNombres');
            $table->string('cApellidos');
            $table->string('cCorreo', 191)->unique();
            $table->integer('nTipoPersona')->default(1);
            $table->integer('nTipoDocumento')->default(1);
            $table->string('cNroDocumento');
            $table->string('cCelular');
            $table->string('cDireccion')->nullable();
            $table->integer('pais_id');
            $table->string('ciudad_id');
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
        Schema::dropIfExists('clientes');
    }
}
