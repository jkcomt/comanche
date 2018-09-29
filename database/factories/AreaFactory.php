<?php

use Faker\Generator as Faker;

$factory->define(App\Area::class, function (Faker $faker) {
    return [
        'descripcion' => $faker->sentence(2,true),
        'estado' => 'Habilitado'
    ];
});
