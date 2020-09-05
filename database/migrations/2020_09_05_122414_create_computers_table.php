<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComputersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('computers', function (Blueprint $table) {
            $table->id();

            $table->string('asset_tag');
            $table->string('pc_name');

            $table->foreignId('type')->references('id')->on('computer_types');
            $table->foreignId('department_id')->nullable()->references('id')->on('departments');
            $table->foreignId('system_details_id')->nullable()->references('id')->on('system_details');
            $table->foreignId('network_details_id')->nullable()->references('id')->on('network_details');
            $table->foreignId('warranty_id')->nullable()->references('id')->on('warranties');

            $table->string('remarks')->nullable();
            $table->string('issues')->nullable();
            $table->string('status')->default('Available');

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
        Schema::dropIfExists('computers');
    }
}
