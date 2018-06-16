<?php

use Illuminate\Database\Seeder;

class CampagnesPublicitairesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\CampagnePublicitaire::class, 5)->create()->each(function ($cp) {
        	$cp->bannieres()->save(factory(App\Banniere::class)->states('horizontal')->make());
        	$cp->bannieres()->save(factory(App\Banniere::class)->states('vertical')->make());
        	$cp->bannieres()->save(factory(App\Banniere::class)->states('mobile')->make());
        });
    }
}
