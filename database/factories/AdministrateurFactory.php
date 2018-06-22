<?php

use Faker\Generator as Faker;

$factory->define(App\Administrateur::class, function (Faker $faker) {
    return [
        'nom' => $faker->name,
        'password' => Hash::make('password'), //$faker->sha256,
        'email' => $faker->email,
        'adresse_id' => function () {
            return factory(App\Adresse::class)->create()->id;
        }
    ];
});
