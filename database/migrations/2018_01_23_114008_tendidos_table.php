<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TendidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tendidos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nro_guia_tendido',15);
            $table->date('fecha');
            $table->time('hora');
            $table->integer('nro_sacos_pre_secado');
            $table->decimal('kilos_pre_secado',10,2);
            $table->integer('nro_sacos_a_secar');
            $table->decimal('kilos_a_secar',10,2);
            $table->integer('nro_sacos_no_secado');
            $table->decimal('kilos_no_secado',10,2);
            $table->integer('lote_secado_id')->unsigned()->nullable();
            $table->foreign('lote_secado_id')->references('id')->on('lote_secados');
            $table->integer('responsable_id')->unsigned()->nullable();
            $table->foreign('responsable_id')->references('id')->on('responsable_cuadrillas');
            $table->string('observacion',50)->nullable();
            $table->string('estado_tendido',45);
            $table->string('estado',45)->nullable();
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
        Schema::dropIfExists('tendidos');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
