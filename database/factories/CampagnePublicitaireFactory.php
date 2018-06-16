<?php

use Faker\Generator as Faker;

$factory->define(App\CampagnePublicitaire::class, function (Faker $faker) {
	$dateFin = $faker->dateTimeThisYear;
	$dateDebut = $faker->dateTimeThisYear($max = $dateFin);
    return [
        'nom' => $faker->text($maxNbChars = 20),
        'budget' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 500),
        'date_fin' => $dateFin,
        'date_debut' => $dateDebut,
        'active' => $faker->boolean,
        'administrateur_publicite_id' => App\AdministrateurPublicite::inRandomOrder()->first()
    ];
});
