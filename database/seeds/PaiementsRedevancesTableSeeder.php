<?php

use Illuminate\Database\Seeder;

class PaiementsRedevancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($r = 0; $r < 10; $r++) {
            $montant = 0;
            $redevances = [];
            for($i = 0; $i < random_int(1, 10); $i++) {
                $redevance = factory(App\Redevance::class)->make();
                $montant += $redevance->montant;
                $redevances[] = $redevance;
            }
            factory(App\PaiementRedevance::class)->create(['administrateur_site_id' => App\AdministrateurSite::inRandomOrder()->first(), 'montant' => $montant])->each(function ($pr) use ($redevances) {
                foreach($redevances as $redevance) {
                    $pr->redevances()->save($redevance);
                }
            });
        }
    }
}
