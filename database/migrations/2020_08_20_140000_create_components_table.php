<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('components', function (Blueprint $table) {
            $table->id();

            $table->string('asset_tag');
            $table->string('component_name');
            $table->foreignId('component_type_id')->references('id')->on('component_types');
            $table->foreignId('system_id')->nullable();
            $table->foreignId('warranty_id')->nullable()->references('id')->on('warranties');
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
        Schema::dropIfExists('components');
    }
}
