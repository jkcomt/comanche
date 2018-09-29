<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockProductoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_producto_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serie_producto');
            $table->string('descripcion_producto');
            $table->decimal('precio');
            $table->decimal('kilos')->nullable();
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
        Schema::dropIfExists('stock_producto_items');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
