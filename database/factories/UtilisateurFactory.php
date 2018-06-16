<?php

use Faker\Generator as Faker;

$factory->define(App\Utilisateur::class, function (Faker $faker) {
    return [
        'token' => $faker->uuid,
        'addresse_ip' => $faker->ipv4,
    ];
});
