<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecojosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recojos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nro_guia_recojo',15);
            $table->date('fecha');
            $table->time('hora');

            $table->integer('nro_sacos_recogidos');
            $table->decimal('kilos_recogidos',10,2);
            $table->decimal('peso_recogidos',10,2);

            $table->integer('nro_sacos_no_recogidos');
            $table->decimal('kilos_no_recogidos',10,2);
            $table->decimal('peso_no_recogido',10,2);

            $table->decimal('importe_sacos',10,2);
            $table->decimal('importe_total',10,2);

            $table->decimal('humedad_al_recoger',10,2);

            $table->string('observacion',50)->nullable();
            $table->string('estado',45)->nullable();

            $table->integer('tendido_id')->unsigned()->nullable();
            $table->foreign('tendido_id')->references('id')->on('tendidos');

            $table->integer('almacen_id')->unsigned()->nullable();
            $table->foreign('almacen_id')->references('id')->on('almacenes');
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
        Schema::dropIfExists('recojos');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
