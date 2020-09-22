<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeripheralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peripherals', function (Blueprint $table) {
            $table->id();
            $table->string('asset_tag');
            $table->string('peripheral_name');
            $table->foreignId('setup_id')->refences('id')->on('peripheral_setups');
            $table->foreignId('peripheral_type')->references('id')->on('peripheral_types');
            $table->foreignId('warranty_id')->refences('id')->on('warranty') ;
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
        Schema::dropIfExists('peripherals');
    }
}
