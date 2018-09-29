<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockResultadoProduccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_resultado_producciones', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('stock_producto_id')->unsigned()->nullable();
            $table->foreign('stock_producto_id')->references('id')->on('stock_producto_items');

            $table->integer('lote_id')->unsigned()->nullable();
            $table->foreign('lote_id')->references('id')->on('lotes');

            $table->integer('produccion_ingreso_id')->unsigned()->nullable();
            $table->foreign('produccion_ingreso_id')->references('id')->on('produccion_ingresos');

            $table->integer('nueva_produccion_id')->unsigned()->nullable();
            $table->foreign('nueva_produccion_id')->references('id')->on('nueva_producciones');

            $table->integer('resultado_producion_id')->unsigned()->nullable();
            $table->foreign('resultado_producion_id')->references('id')->on('resultado_produciones');

            $table->integer('cantidad_inicial');
            $table->integer('cantidad_stock');
            $table->decimal('kilos')->nullable();
            $table->boolean('estado_stock');//0 si aun hay stock, y 1 si ya se vendio el total del stock
            $table->date('fecha_registro');
            $table->time('hora_registro');
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
      Schema::dropIfExists('stock_resultado_producciones');
      DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
