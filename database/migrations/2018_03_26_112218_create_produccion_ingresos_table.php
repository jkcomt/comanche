<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduccionIngresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produccion_ingresos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nro_guia_ingreso',45);
            $table->integer('lote_id')->unsigned()->nullable();
            $table->foreign('lote_id')->references('id')->on('lotes');

            $table->integer('lote_secado_id')->unsigned()->nullable();
            $table->foreign('lote_secado_id')->references('id')->on('lote_secados');

            $table->string('estado_prod_ingreso');
            $table->string('nro_sacos_ingresados')->nullable();

            $table->decimal('kilo_por_saco',10,2);
            $table->string('area_origen')->nullable();
            $table->boolean('conforme')->nullable();
            $table->date('fecha');
            $table->time('hora');
            $table->string('estado',45)->nullable();
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
        Schema::dropIfExists('produccion_ingresos');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
