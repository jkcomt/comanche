<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('apellidos',20);
            $table->string('nombres',20);
            $table->string('dni',8);
            $table->string('celular',12)->nullable();
            $table->string('direccion',20)->nullable();
            $table->string('email',20)->nullable();
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
        Schema::dropIfExists('personales');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
