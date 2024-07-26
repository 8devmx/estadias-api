<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldsToCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->text('sobre_mi')->nullable();
            $table->text('experiencia')->nullable();
            $table->text('educacion')->nullable();
            $table->text('habilidades')->nullable();
            $table->text('intereses')->nullable();
            $table->text('premios')->nullable();
            $table->string('foto_perfil')->nullable();
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
            $table->dropColumn([
                'sobre_mi', 
                'experiencia', 
                'educacion', 
                'habilidades', 
                'intereses', 
                'premios', 
                'foto_perfil'
            ]);
        });
    }
}
