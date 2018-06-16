<?php

use Illuminate\Database\Seeder;

class PagesWebTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PageWeb::class, 100)->create();
    }
}
