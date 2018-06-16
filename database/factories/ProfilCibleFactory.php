<?php

use Faker\Generator as Faker;

$factory->define(App\ProfilCible::class, function (Faker $faker) {
    return [
        'nom' => $faker->text($maxNbChars = 20)
    ];
});
