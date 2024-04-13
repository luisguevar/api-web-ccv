<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('cRazonSocial');
            $table->tinyInteger('nTipoPersona');
            $table->tinyInteger('nTipoDocumento');
            $table->string('cNroDocumento');
            $table->string('cCelular');
            $table->string('cCorreo');
            $table->string('cPaginaWeb')->nullable();
            $table->string('cDireccion');
            $table->string('cActividadPrincipal');
            $table->text('cObservaciones')->nullable();
            $table->tinyInteger('nEstado');
            $table->string('cUsuarioCreacion');
            $table->string('cUsuarioModificacion');
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
        Schema::dropIfExists('proveedores');
    }
}
