<?php

use Illuminate\Database\Seeder;

class AdministrateursSiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\AdministrateurSite::class, 10)->create();
    }
}
