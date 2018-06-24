<?php

use Illuminate\Database\Seeder;

class ProfilsCibleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ProfilCible::class, 10)->create();
    }
}
