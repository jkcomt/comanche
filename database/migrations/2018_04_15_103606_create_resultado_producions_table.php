<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultadoProducionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultado_produciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('producto');
            $table->integer('nro_sacos');
            $table->decimal('kilos',10,2);
            $table->decimal('precio_maquila',10,2);
            $table->decimal('sub_total_maquila',10,2);
            $table->integer('nro_envases');
            $table->string('envase');
            $table->decimal('precio_envase');
            $table->decimal('sub_total_envase');
            $table->decimal('adicional');
            $table->decimal('sub_total_adicional');
            $table->integer('nueva_produccion_id')->unsigned()->nullable();
            $table->foreign('nueva_produccion_id')->references('id')->on('nueva_producciones');
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
        Schema::dropIfExists('resultado_produciones');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
