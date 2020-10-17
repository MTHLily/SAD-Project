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

            $table->foreignId('motherboard_id')->nullable()->references('id')->on('components')->onDelete('set null');
            $table->foreignId('processor_id')->nullable()->references('id')->on('components')->onDelete('set null');
            $table->foreignId('gpu_id')->nullable()->references('id')->on('components')->onDelete('set null');
            $table->foreignId('operating_system_id')->nullable()->references('id')->on('operating_systems');

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
