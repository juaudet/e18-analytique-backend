<?php

use Faker\Generator as Faker;

$factory->define(App\SiteWebProfilCible::class, function (Faker $faker) {
    $profilCible = App\ProfilCible::inRandomOrder()->first();
    return [
        'profil_cible_id' => $profilCible,
        'url' => $faker->domainName
    ];
});
