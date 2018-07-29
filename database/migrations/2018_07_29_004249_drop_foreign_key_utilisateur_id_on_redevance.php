<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropForeignKeyUtilisateurIdOnRedevance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('redevances', function (Blueprint $table) {
            $table->dropForeign(['utilisateur_id']);
            $table->dropColumn('utilisateur_id');
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
            $table->unsignedInteger('utilisateur_id')
                    ->nullable(true);
            $table->foreign('utilisateur_id')
                    ->references('id')
                    ->on('utilisateurs');
        }); 
    }
}
