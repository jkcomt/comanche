<?php

use Faker\Generator as Faker;

$factory->define(\App\Empresa::class, function (Faker $faker) {
    return [
        'razon_social'=>$faker->company,
        'ruc'=>$faker->unique()->randomNumber(9,false).$faker->unique()->randomNumber(1,false),
        'direccion'=>$faker->address,
        'telefono'=>$faker->unique()->randomNumber(9,false),
        'email'=>$faker->email,
        'representante'=>$faker->firstName().' '.$faker->lastName,
        'dni_representante'=>$faker->unique()->randomNumber(8,false),
        'estado'=>'Habilitado'
    ];
});
