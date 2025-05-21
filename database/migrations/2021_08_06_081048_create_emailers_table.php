<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emailers', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('desc')->nullable();
            $table->string('thumb')->nullable();
            $table->string('button_slug')->nullable();
            $table->string('official_web_page')->nullable();
            $table->string('place_for_venue')->nullable();
            $table->string('dates')->nullable();
            $table->string('conference_organize')->nullable();
            $table->string('conference_manager')->nullable();
            $table->string('conference_administrator')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
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
        Schema::dropIfExists('emailers');
    }
}
