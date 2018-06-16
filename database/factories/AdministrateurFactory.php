<?php

use Faker\Generator as Faker;

$factory->define(App\Administrateur::class, function (Faker $faker) {
    return [
        'nom' => $faker->name,
        'mot_de_passe' => $faker->sha256,
        'courriel' => $faker->email,
        'adresse_id' => function () {
            return factory(App\Adresse::class)->create()->id;
        }
    ];
});
