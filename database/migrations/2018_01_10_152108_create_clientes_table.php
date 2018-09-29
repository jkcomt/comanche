<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('apellidos',100)->nullable();
            $table->string('nombres',100);
            $table->string('dni',20);
            $table->string('celular',20)->nullable();
            $table->string('direccion',200)->nullable();
            $table->string('email',200)->nullable();
            $table->string('ruc',12)->nullable();
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
        Schema::dropIfExists('clientes');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
