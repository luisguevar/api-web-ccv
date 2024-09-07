<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->string('cCorrelativo')->nullable()->collation('utf8mb4_0900_ai_ci');
            $table->integer('nTipoOrigen')->default(1);;
            $table->integer('cliente_id');
            $table->integer('vendedor_id');
            $table->dateTime('dFechaVenta')->nullable();
            $table->integer('nTipoComprobante');
            $table->integer('nTipoPago');
            $table->double('nEfectivoRecibido');
            $table->tinyInteger('bEfectivoExacto');
            $table->double('nVuelto')->nullable();
            $table->string('cCodigoOperacion')->nullable();
            $table->double('nSubTotal');
            $table->decimal('IGV', 10, 2);
            $table->double('nValorIGV');
            $table->double('nDescuento')->nullable();
            $table->double('nTotal');
            $table->text('cObservaciones')->nullable();
            $table->integer('nEstado')->default(1);
            $table->tinyInteger('bCompletado')->default(0);
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
        Schema::dropIfExists('ventas');
    }
}
