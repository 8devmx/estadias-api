<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadHistorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_historials', function (Blueprint $table) {
            $table->id(); // Esta es la única columna que debe tener auto_increment
            $table->string('name', 80);
            $table->string('phone', 80);
            $table->string('mail', 80);
            $table->string('state', 80);
            $table->string('city', 255);
            $table->string('source', 255);
            $table->string('interest', 255);
            $table->text('message');
            $table->string('status', 80);
            $table->unsignedBigInteger('company_id');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('company')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lead_historials');
    }
}
