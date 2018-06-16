<?php

use Faker\Generator as Faker;

$factory->define(App\PaiementRedevance::class, function (Faker $faker) {
    return [
        'no_transaction' => $faker->uuid,
        'date' => $faker->dateTimeThisYear,
        'montant' => 0
    ];
});
