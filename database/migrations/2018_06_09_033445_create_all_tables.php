<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {          
        Schema::create('campagnes_publicitaires', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->decimal('budget', 8, 2);
            $table->timestamp('date_debut')
                ->nullable($value = true);
            $table->timestamp('date_fin')
                ->nullable($value = true);
            $table->boolean('active');
        });            
        Schema::create('bannieres', function (Blueprint $table) {
            $table->increments('id');
            $table->binary('image');
            $table->enum('format', ['horizontal', 'vertical', 'mobile']);
            $table->string('url');
            $table->unsignedInteger('campagne_publicitaire_id');
            $table->foreign('campagne_publicitaire_id')
                ->references('id')
                ->on('campagnes_publicitaires')
                ->onDelete('cascade');
        });            
        Schema::create('paiements_redevances', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('no_transaction');
            $table->timestamp('date');
            $table->decimal('montant', 8, 2);
        });            
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('token');
            $table->string('addresse_ip');
        });            
        Schema::create('redevances', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('cliquee');
            $table->boolean('ciblee');
            $table->decimal('montant', 8, 2);
            $table->unsignedInteger('banniere_id')
                ->nullable($value = true);
            $table->unsignedInteger('paiement_redevance_id');
            $table->unsignedInteger('utilisateur_id');
            $table->foreign('banniere_id')
                ->references('id')
                ->on('bannieres')
                ->onDelete('set null');
            $table->foreign('paiement_redevance_id')
                ->references('id')
                ->on('paiements_redevances');
            $table->foreign('utilisateur_id')
                ->references('id')
                ->on('utilisateurs');
        });            
        Schema::create('sites_web', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
        });            
        Schema::create('pages_web', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->timestamp('date_visite');
            $table->string('navigateur');
            $table->unsignedInteger('utilisateur_id');
            $table->unsignedInteger('site_web_id');
            $table->foreign('utilisateur_id')
                ->references('id')
                ->on('utilisateurs');
            $table->foreign('site_web_id')
                ->references('id')
                ->on('sites_web');
        });
        Schema::create('adresses', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('no_civique');
            $table->string('rue');
            $table->string('ville');
            $table->string('code_postal');
        });  
        Schema::create('administrateurs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('mot_de_passe');
            $table->string('courriel');
            $table->unsignedInteger('adresse_id');
            $table->foreign('adresse_id')
                ->references('id')
                ->on('adresses');
        });
        Schema::create('administrateurs_site', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_compte_bancaire');
            $table->unsignedInteger('administrateur_id');
            $table->foreign('administrateur_id')
                ->references('id')
                ->on('administrateurs');
            $table->unsignedInteger('site_web_id');
            $table->foreign('site_web_id')
                ->references('id')
                ->on('sites_web');
        });
        Schema::create('administrateurs_publicite', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('administrateur_id');
            $table->foreign('administrateur_id')
                ->references('id')
                ->on('administrateurs');
        });
        Schema::table('paiements_redevances', function (Blueprint $table) {
            $table->unsignedInteger('administrateurs_site_id');
            $table->foreign('administrateurs_site_id')
                ->references('id')
                ->on('administrateurs_site');
        });
        Schema::create('profils_cible', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->unsignedInteger('administrateurs_publicite_id');
            $table->foreign('administrateurs_publicite_id')
                ->references('id')
                ->on('administrateurs_publicite');
        });
        Schema::create('sites_web_profil_cible', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->unsignedInteger('profil_cible_id');
            $table->foreign('profil_cible_id')
                ->references('id')
                ->on('profils_cible')
                ->onDelete('cascade');
        });
        Schema::table('campagnes_publicitaires', function (Blueprint $table) {
            $table->unsignedInteger('administrateurs_publicite_id');
            $table->foreign('administrateurs_publicite_id')
                ->references('id')
                ->on('administrateurs_publicite');
        });
        Schema::create('campagne_publicitaire_profil_cible', function($table) {
            $table->increments('id');
            $table->unsignedInteger('campagne_publicitaire_id');
            $table->foreign('campagne_publicitaire_id', 'cp_campagne_publicitaire_fk')
                ->references('id')
                ->on('campagnes_publicitaires');
            $table->unsignedInteger('profil_cible_id');
            $table->foreign('profil_cible_id', 'cp_profil_cible_fk')
                ->references('id')
                ->on('profils_cible');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bannieres', function (Blueprint $table) {
            $table->dropForeign(['campagne_publicitaire_id']);
        });
        Schema::table('redevances', function (Blueprint $table) {
            $table->dropForeign(['banniere_id']);
            $table->dropForeign(['paiement_redevance_id']);
            $table->dropForeign(['utilisateur_id']);
        });
        Schema::table('pages_web', function (Blueprint $table) {
            $table->dropForeign(['utilisateur_id']);
            $table->dropForeign(['site_web_id']);
        });
        Schema::table('administrateurs', function (Blueprint $table) {
            $table->dropForeign(['adresse_id']);

        });
        Schema::table('administrateurs_site', function (Blueprint $table) {
            $table->dropForeign(['administrateur_id']);
            $table->dropForeign(['site_web_id']);
        });
        Schema::table('administrateurs_publicite', function (Blueprint $table) {
            $table->dropForeign(['administrateur_id']);
        });
        Schema::table('paiements_redevances', function (Blueprint $table) {
            $table->dropForeign(['administrateurs_site_id']);

        });
        Schema::table('profils_cible', function (Blueprint $table) {
            $table->dropForeign(['administrateurs_publicite_id']);

        });
        Schema::table('sites_web_profil_cible', function (Blueprint $table) {
            $table->dropForeign(['profil_cible_id']);

        });
        Schema::table('campagnes_publicitaires', function (Blueprint $table) {
            $table->dropForeign(['administrateurs_publicite_id']);

        });
        Schema::table('campagne_publicitaire_profil_cible', function (Blueprint $table) {
            $table->dropForeign('cp_campagne_publicitaire_fk');
            $table->dropForeign('cp_profil_cible_fk');
        });
        Schema::dropIfExists('campagnes_publicitaires');
        Schema::dropIfExists('bannieres');
        Schema::dropIfExists('paiements_redevances');
        Schema::dropIfExists('utilisateurs');
        Schema::dropIfExists('redevances');
        Schema::dropIfExists('adresses');
        Schema::dropIfExists('sites_web');
        Schema::dropIfExists('pages_web');
        Schema::dropIfExists('administrateurs');
        Schema::dropIfExists('administrateurs_site');
        Schema::dropIfExists('administrateurs_publicite');
        Schema::dropIfExists('profils_cible');
        Schema::dropIfExists('sites_web_profil_cible');
        Schema::dropIfExists('campagne_publicitaire_profil_cible');
    }
}
