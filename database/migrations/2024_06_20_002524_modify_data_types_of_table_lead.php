<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyDataTypesOfTableLead extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lead', function (Blueprint $table) {
            $table->string('mail')->unique() ->change();
            $table->integer('status')->default(0) ->change(); // 1 para válido, 0 para no válido
            $table->integer('company_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lead', function (Blueprint $table) {
            //
        });
    }
}
