<?php

use Faker\Generator as Faker;

$factory->define(App\SiteWebProfilCible::class, function (Faker $faker) {
    return [
        'url' => $faker->domainName
    ];
});
