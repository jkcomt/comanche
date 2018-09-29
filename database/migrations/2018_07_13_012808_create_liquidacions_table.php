<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiquidacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serie_liquidacion');
            $table->integer('lote_id')->unsigned()->nullable();
            $table->foreign('lote_id')->references('id')->on('lotes');
            $table->boolean('estado_liquidacion');
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
        Schema::dropIfExists('liquidaciones');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
