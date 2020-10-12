<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarrantiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warranties', function (Blueprint $table) {
            
            $table->id();

            $table->foreignId('brand_id')->references('id')->on('brands');
            $table->dateTime('purchase_date');
            $table->string('purchase_location');
            $table->string('receipt_url')->nullable();
            $table->string('serial_no')->nullable();
            $table->dateTime('warranty_life')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->default('Active');

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
        Schema::dropIfExists('warranties');
    }
}
