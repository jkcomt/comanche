<?php

use Faker\Generator as Faker;

$factory->define(App\Lote::class, function (Faker $faker) {
    return [
        'compania'=>\Carbon\Carbon::now()->year,
        'nro_guia'=>'001-00000'.$faker->unique()->randomNumber(1,false),
        'fecha'=>\Carbon\Carbon::now()->toDateString(),
        'hora'=>\Carbon\Carbon::now()->toTimeString(),
        'tipo_recepcion'=>'Agricultor',
        'tipo_peso'=>'sacos',
        'nro_sacos'=>8,
        'kilos'=>100,
        'peso_real'=>800,
        'tipo_flete'=>'Saco',
        'pagado_por'=>'Agricultor',
        'flete_x_saco'=>100,
        'flete_x_peso'=>0,
        'flete_x_tonelada'=>0,
        'flete_total'=>800,
        'nro_humedad_mayor_13'=>4,
        'nro_humedad_menor_13'=>4,
        'observacion'=>'nada',
        'conforme'=>false,
        'estado'=>'Habilitado',
        'personal_id'=>1,
        'vehiculo_id'=>1,
        'chofer_id'=>1,
        'procedencia_id'=>1,
        //'cliente_id'=>1,
        'agricultor_id'=>1,
        'variedad_id'=>1

    ];
});