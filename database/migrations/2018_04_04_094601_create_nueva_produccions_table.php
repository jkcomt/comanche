<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNuevaProduccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nueva_producciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('produccion_ingreso_id')->unsigned()->nullable();
            $table->foreign('produccion_ingreso_id')->references('id')->on('produccion_ingresos');
            $table->string('nro_guia_salida');
            $table->integer('nro_sacos_stock_inicial');
            $table->decimal('kilos_total_inicial',10,2);
            $table->integer('nro_sacos_a_procesar');
            $table->decimal('kilos_a_procesar',10,2);
            $table->integer('nro_sacos_saldo');
            $table->decimal('kilos_total_saldo',10,2);
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
        Schema::dropIfExists('nueva_producciones');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
