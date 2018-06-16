<?php

use Illuminate\Database\Seeder;

class AdministrateursPubliciteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\AdministrateurPublicite::class, 10)->create()->each(function ($ap) {
            for($i = 0; $i <= random_int(0, 10); $i++) {
                $pc = $ap->profilsCible()->save(factory(App\ProfilCible::class)->make());
                for($i = 0; $i <= random_int(0, 10); $i++) {
                    $pc->sitesWebProfilCible()->save(factory(App\SiteWebProfilCible::class)->make());
                }
            }
        });
    }
}
