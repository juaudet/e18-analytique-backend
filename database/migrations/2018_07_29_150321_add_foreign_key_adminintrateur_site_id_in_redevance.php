<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyAdminintrateurSiteIdInRedevance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('redevances', function (Blueprint $table) {
            $table->unsignedInteger('administrateur_site_id')
                ->nullable($value = true);;
            $table->foreign('administrateur_site_id')
                ->references('id')
                ->on('administrateurs_site');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('redevances', function (Blueprint $table) {
            $table->dropForeign(['administrateur_site_id']);
            $table->dropColumn('administrateur_site_id');
        });
    }
}
