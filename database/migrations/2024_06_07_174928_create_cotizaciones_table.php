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
            $table->string('cCorrelativo')->collation('utf8mb4_0900_ai_ci');
            $table->date('dFechaEmision');
            $table->date('dFechaExpiracion');
            $table->double('nTotal');
            $table->text('cObservaciones')->nullable();
            $table->float('nValorDescuento');
            $table->integer('nEstado')->default(1);
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
