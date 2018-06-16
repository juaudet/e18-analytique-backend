<?php

use Faker\Generator as Faker;

$factory->define(App\Banniere::class, function (Faker $faker) {
    return [
        // 'image' => $image,
        // 'format' => $formatImage,
        'url' => $faker->url
    ];
});

$factory->state(App\Banniere::class, 'horizontal', function ($faker) {
	// https://stackoverflow.com/a/20564797
    // https://stackoverflow.com/a/44719681
    // https://stackoverflow.com/a/25127223
	$image = '\\x' . bin2hex(file_get_contents($faker->image($dir = null, $width = 728, $height = 90)));
    return [
        'format' => 'horizontal',
        'image' => $image
    ];
});

$factory->state(App\Banniere::class, 'vertical', function ($faker) {
	$image = '\\x' . bin2hex(file_get_contents($faker->image($dir = null, $width = 120, $height = 600)));
    return [
        'format' => 'vertical',
        'image' => $image
    ];
});

$factory->state(App\Banniere::class, 'mobile', function ($faker) {
	$image = '\\x' . bin2hex(file_get_contents($faker->image($dir = null, $width = 320, $height = 100)));
    return [
        'format' => 'mobile',
        'image' => $image
    ];
});