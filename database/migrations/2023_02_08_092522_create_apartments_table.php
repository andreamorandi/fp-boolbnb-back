<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->tinyInteger('room_number');
            $table->tinyInteger('bed_number');
            $table->tinyInteger('bathroom_number');
            $table->smallInteger('surface_sqm');
            $table->string('full_address', 255);
            $table->string('image', 255)->nullable();
            $table->tinyInteger('is_visible')->unsigned()->default(1);
            $table->string('latitude', 50)->nullable();
            $table->string('longitude', 50)->nullable();
            $table->string('slug');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
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
        Schema::dropIfExists('apartments');
    }
};
