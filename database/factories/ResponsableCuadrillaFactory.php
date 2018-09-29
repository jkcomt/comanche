<?php

use Faker\Generator as Faker;

$factory->define(App\ResponsableCuadrilla::class, function (Faker $faker) {
    return [
        'apellidos'=>$faker->lastName,
        'nombres'=>$faker->firstName(),
        'dni'=>$faker->unique()->randomNumber(8,false),
        'celular'=>$faker->unique()->randomNumber(9,false),
        'estado'=>'Habilitado'
    ];
});
