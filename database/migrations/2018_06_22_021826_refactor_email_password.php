<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RefactorEmailPassword extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('administrateurs', function (Blueprint $table) {
            $table->renameColumn('courriel', 'email');
            $table->renameColumn('mot_de_passe', 'password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('administrateurs', function (Blueprint $table) {
            $table->renameColumn('email', 'courriel');
            $table->renameColumn('password', 'mot_de_passe');
        });
    }
}
