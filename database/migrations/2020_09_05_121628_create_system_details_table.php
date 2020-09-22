<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('motherboard_id')->references('id')->on('components');
            $table->foreignId('processor_id')->references('id')->on('components');
            $table->foreignId('gpu_id')->references('id')->on('components');
            $table->foreignId('operating_system_id')->references('id')->on('operating_systems');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_details');
    }
}
