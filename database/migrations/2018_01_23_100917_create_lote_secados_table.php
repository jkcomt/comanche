<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoteSecadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lote_secados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lote_id')->unsigned()->nullable();
            $table->foreign('lote_id')->references('id')->on('lotes');
            $table->string('nro_serie_guia')->nullable();
            $table->boolean('conforme',false)->nullable();
            $table->string('estado_secado');
            $table->date('fecha');
            $table->time('hora');
            $table->string('estado');
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
        Schema::dropIfExists('lote_secados');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
