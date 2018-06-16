<?php

use Faker\Generator as Faker;

$factory->define(App\SiteWeb::class, function (Faker $faker) {
    return [
        'url' => $faker->domainName,
    ];
});
