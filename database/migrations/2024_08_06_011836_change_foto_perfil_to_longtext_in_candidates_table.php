<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFotoPerfilToLongtextInCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidates', function (Blueprint $table) {
            // Cambia el tipo de la columna 'foto_perfil' a LONGTEXT
            $table->longText('foto_perfil')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidates', function (Blueprint $table) {
            // 
        });
    }
}
