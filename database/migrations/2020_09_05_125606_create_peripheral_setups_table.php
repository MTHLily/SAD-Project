<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeripheralSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peripheral_setups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_id')->references('id')->on('peripherals');
            $table->foreignId('keyboard_id')->references('id')->on('peripherals');
            $table->foreignId('phone_id')->references('id')->on('peripherals');
            $table->foreignId('tablet_id')->references('id')->on('peripherals');

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
        Schema::dropIfExists('peripheral_setups');
    }
}
