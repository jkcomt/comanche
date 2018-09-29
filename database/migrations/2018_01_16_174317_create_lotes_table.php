<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('compania',20);
            $table->string('nro_guia',15);
            $table->date('fecha');
            $table->time('hora');
            $table->string('tipo_recepcion',100);
            $table->string('tipo_peso');
            $table->integer('nro_sacos');
            $table->decimal('kilos',10,2);
            $table->decimal('peso_real',10,2);
            $table->string('tipo_flete',45);
            $table->string('pagado_por',45);
            $table->decimal('flete_x_saco',10,2);
            $table->decimal('flete_x_peso',10,2);
            $table->decimal('flete_x_tonelada',10,2);
            $table->decimal('flete_total',10,2);
            $table->integer('nro_humedad_mayor_13',0);
            $table->integer('nro_humedad_menor_13',0);
            $table->longText('observacion')->nullable();
            $table->boolean('conforme');
            $table->integer('personal_id')->unsigned()->nullable();
            $table->foreign('personal_id')->references('id')->on('personales');
            $table->integer('vehiculo_id')->unsigned()->nullable();
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
            $table->integer('chofer_id')->unsigned()->nullable();
            $table->foreign('chofer_id')->references('id')->on('choferes');
            $table->integer('procedencia_id')->unsigned()->nullable();
            $table->foreign('procedencia_id')->references('id')->on('procedencias');
            $table->integer('cliente_id')->unsigned()->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->integer('agricultor_id')->unsigned()->nullable();
            $table->foreign('agricultor_id')->references('id')->on('agricultores');
            $table->integer('empresa_id')->unsigned()->nullable();
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->integer('variedad_id')->unsigned()->nullable();
            $table->foreign('variedad_id')->references('id')->on('variedades');
            $table->string('estado',45);
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
        Schema::dropIfExists('lotes');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
