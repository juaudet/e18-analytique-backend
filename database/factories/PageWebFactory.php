<?php

use Faker\Generator as Faker;

$factory->define(App\PageWeb::class, function (Faker $faker) {
	$siteWeb = App\SiteWeb::inRandomOrder()->first();
    return [
        'url' => $siteWeb->url . '/' . $faker->slug,
        'date_visite' => $faker->dateTimeThisYear,
        'navigateur' => $faker->userAgent,
        // https://stackoverflow.com/a/38409423
        'utilisateur_id' => App\Utilisateur::inRandomOrder()->first(), 
        'site_web_id' => $siteWeb
    ];
});
