<?php

use Faker\Generator as Faker;

$factory->define(App\SiteWeb::class, function (Faker $faker) {
   $adminSite = App\AdministrateurSite::inRandomOrder()->first();
    return [
        'url' => $faker->domainName,
    ];
});
