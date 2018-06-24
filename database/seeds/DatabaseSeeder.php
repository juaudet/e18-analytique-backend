<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdministrateursPubliciteTableSeeder::class,
            AdministrateursSiteTableSeeder::class,
            UtilisateursTableSeeder::class,
            PagesWebTableSeeder::class,
           // CampagnesPublicitairesTableSeeder::class,
            PaiementsRedevancesTableSeeder::class,
            RedevancesTableSeeder::class,
        ]);
    }
}
