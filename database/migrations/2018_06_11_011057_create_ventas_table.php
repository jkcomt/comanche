<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('nro_guia_venta');
            $table->date('fecha_venta');
            $table->time('hora_venta');
            //persona natural, empresa
            $table->string('tipo_cliente');

            $table->integer('comprador_persona_id')->unsigned()->nullable();
            $table->foreign('comprador_persona_id')->references('id')->on('comprador_personas');

            $table->integer('comprador_empresa_id')->unsigned()->nullable();
            $table->foreign('comprador_empresa_id')->references('id')->on('comprador_empresas');

            $table->string('tipo_comprobante');
            $table->string('nro_boleta')->nullable();
            $table->string('nro_factura')->nullable();
            $table->string('nro_ticket')->nullable();

            $table->decimal('igv');
            $table->decimal('total');
            $table->string('observacion');
            $table->string('monto_descripcion');

            $table->date('fecha_registro');
            $table->string('estado');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('ventas');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
