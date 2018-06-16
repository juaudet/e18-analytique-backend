<?php

use Faker\Generator as Faker;

$factory->define(App\AdministrateurSite::class, function (Faker $faker) {
    return [
        'administrateur_id' => function () {
            return factory(App\Administrateur::class)->create()->id;
        },
        'site_web_id' => function () {
            return factory(App\SiteWeb::class)->create()->id;
        },
        'no_compte_bancaire' => $faker->bankAccountNumber
    ];
});
