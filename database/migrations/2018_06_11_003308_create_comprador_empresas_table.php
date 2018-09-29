<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompradorEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comprador_empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('razon_social',30)->nullable();
            $table->string('ruc',12)->nullable();
            $table->string('direccion',20)->nullable();
            $table->string('telefono',10)->nullable();
            $table->string('email',20)->nullable();
            $table->string('representante',40)->nullable();
            $table->string('dni_representante',8)->nullable();
            $table->string('estado',45)->nullable();
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
        Schema::dropIfExists('comprador_empresas');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
