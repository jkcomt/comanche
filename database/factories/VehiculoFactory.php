<?php

use Faker\Generator as Faker;

$factory->define(App\Vehiculo::class, function (Faker $faker) {
    return [
        'marca'=>$faker->company,
        'descripcion'=>$faker->sentence(3,true),
        'placa'=>$faker->word.$faker->randomNumber(3,false),
        'estado'=>'Habilitado'
    ];
});
