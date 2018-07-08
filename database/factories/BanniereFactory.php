<?php

use Faker\Generator as Faker;

$factory->define(App\Banniere::class, function (Faker $faker) {
    return [
        // 'image' => $image,
        // 'format' => $formatImage,
        'url' => $faker->url
    ];
});

// width = 728, height = 90
$factory->state(App\Banniere::class, 'horizontal', function ($faker) {
	// https://stackoverflow.com/a/20564797
    // https://stackoverflow.com/a/44719681
    // https://stackoverflow.com/a/25127223
	$image = 'data:image/png;base64,' . base64_encode(file_get_contents('./database/seed-assets/banniere-horizontale.png'));
    return [
        'format' => 'horizontal',
        'image' => $image
    ];
});

// width = 120, height = 600
$factory->state(App\Banniere::class, 'vertical', function ($faker) {
	$image = 'data:image/png;base64,' . base64_encode(file_get_contents('./database/seed-assets/banniere-verticale.png'));
    return [
        'format' => 'vertical',
        'image' => $image
    ];
});

// width = 320, height = 100
$factory->state(App\Banniere::class, 'mobile', function ($faker) {
	$image = 'data:image/png;base64,' . base64_encode(file_get_contents('./database/seed-assets/banniere-mobile.png'));
    return [
        'format' => 'mobile',
        'image' => $image
    ];
});