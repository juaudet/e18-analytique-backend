<?php

use Faker\Generator as Faker;

$factory->define(App\Adresse::class, function (Faker $faker) {
    return [
        'no_civique' => $faker->numberBetween(100, 9999),
        'rue' => $faker->streetName,
        'ville' => $faker->city,
        'code_postal' => $faker->regexify('[ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWX
        YZ]\d[ABCEGHJKLMNPRSTVWXYZ]\d'),
        'administrateur_id' => App\Administrateur::inRandomOrder()->first()
    ];
});
