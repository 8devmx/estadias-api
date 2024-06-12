<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLead extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 80);
            $table->string('thone', 80);
            $table->string('mail', 80);
            $table->string('state_id', 80);
            $table->string('city', 255);
            $table->string('sources_id', 255);
            $table->string('interest_id', 255);
            $table->text('message');
            $table->string('status_id', 80);
            $table->string('company_id', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lead');
    }
}
