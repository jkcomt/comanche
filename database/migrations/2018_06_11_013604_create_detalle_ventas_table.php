<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('venta_id')->unsigned()->nullable();
            $table->foreign('venta_id')->references('id')->on('ventas');

            $table->integer('stock_producto_id')->unsigned()->nullable();
            $table->foreign('stock_producto_id')->references('id')->on('stock_producto_items');

            $table->integer('stock_resultado_produccions_id')->unsigned()->nullable();
            $table->foreign('stock_resultado_produccions_id')->references('id')->on('stock_resultado_producciones');

            $table->integer('cantidad');
            $table->decimal('kilos')->nullable();
            $table->decimal('precio');

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
        Schema::dropIfExists('detalle_ventas');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
