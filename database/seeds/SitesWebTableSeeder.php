<?php

use Illuminate\Database\Seeder;

class SitesWebTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\SiteWeb::class, 10)->create();
    }
}
