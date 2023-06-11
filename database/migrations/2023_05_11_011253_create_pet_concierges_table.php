<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetConciergesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pet_concierges', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('business_name')->nullable();
            $table->string('contact_person')->nullable();
            $table->text('address')->nullable();
            $table->text('address_map')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('pet_concierges');
    }
}
