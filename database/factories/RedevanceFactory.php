<?php

use Faker\Generator as Faker;

$factory->define(App\Redevance::class, function (Faker $faker) {
	$statut = [
		'cliquee' => $faker->boolean,
        'ciblee' => $faker->boolean
	];
	if($statut['cliquee'] && !$statut['ciblee']) {
		$montant = 0.05;
	} elseif(!$statut['cliquee'] && $statut['ciblee']) {
		$montant = 0.03;
	} elseif($statut['cliquee'] && $statut['ciblee']) {
		$montant = 0.10;
	} else {
		$montant = 0.01;
	}
    return [
        'token' => $faker->uuid,
        'cliquee' => $statut['cliquee'],
        'ciblee' => $statut['ciblee'],
        'date' => $faker->dateTimeThisYear,
        'montant' => $montant,
        'administrateur_site_id' => App\AdministrateurSite::inRandomOrder()->first()
    ];
});
