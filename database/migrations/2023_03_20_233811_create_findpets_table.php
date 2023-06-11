<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFindpetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('findpets', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('image')->nullable();
            $table->string('name')->nullable();
            $table->string('color')->nullable();
            $table->integer('gender')->nullable();
            $table->string('weight')->nullable();
            $table->text('found_location')->nullable();
            $table->text('contact_info')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('findpets');
    }
}
