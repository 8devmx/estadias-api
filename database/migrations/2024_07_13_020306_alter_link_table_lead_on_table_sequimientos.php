<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLinkTableLeadOnTableSequimientos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sequimientos', function (Blueprint $table) {
            $table->foreign('name_client_id')->references('id')->on('lead')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('lead')->onDelete('cascade');
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
