<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyFieldsStateIdToStateAndFielsSourcesIdToSourceAndInterestIdToInterestAndStatusIdToStatusV2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lead', function (Blueprint $table) {
            $table->renameColumn('state_id', 'state');
            $table->renameColumn('sources_id', 'source');
            $table->renameColumn('interest_id', 'interest');
            $table->renameColumn('status_id', 'status');
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
