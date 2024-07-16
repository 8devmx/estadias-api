<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCreateFieldsToLinkV2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sequimientos', function (Blueprint $table) {
            $table->unsignedBigInteger('name_client_id')->change();
            $table->unsignedBigInteger('status_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sequimientos', function (Blueprint $table) {
            //
        });
    }
}
