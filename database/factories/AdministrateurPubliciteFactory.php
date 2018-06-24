<?php

use Faker\Generator as Faker;

$factory->define(App\AdministrateurPublicite::class, function (Faker $faker) {
    return [
    	'administrateur_id' => function () {
            return factory(App\Administrateur::class)->create(['role' => 'publicite'])->id;
        }
    ];
});
