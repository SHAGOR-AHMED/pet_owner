<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('animal_id')->nullable();
            $table->string('code')->nullable();
            $table->integer('owner_id')->nullable();
            $table->string('image')->nullable();
            $table->string('image2')->nullable();
            $table->string('name')->nullable();
            $table->string('breed')->nullable();
            $table->integer('gender')->nullable();
            $table->string('color')->nullable();
            $table->string('dob')->nullable();
            $table->string('sample_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('report_date')->nullable();
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
        Schema::dropIfExists('certificates');
    }
}
