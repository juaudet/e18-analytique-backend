<?php

use Faker\Generator as Faker;

$factory->define(App\ProfilCible::class, function (Faker $faker) {
    $adminPub = App\AdministrateurPublicite::inRandomOrder()->first();
    return [
        'nom' => $faker->text($maxNbChars = 20),
        'administrateur_publicite_id' => $adminPub
    ];
});
