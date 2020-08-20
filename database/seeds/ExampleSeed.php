<?php

use Illuminate\Database\Seeder;

class ExampleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	//Create sample objects
    	$warranty = new App\Warranty;
    	$component = new App\Component;

    	$warranty->brand_id = 1;
    	$warranty->purchase_date = Carbon\Carbon::now();
    	$warranty->purchase_location = 'las vegas';
    	$warranty->receipt_url = 'helloworld';
    	$warranty->serial_no = '1231312';
    	$warranty->warranty_life = Carbon\Carbon::now();

    	$warranty->save();

    	$component->asset_tag = "1234";
    	$component->component_name = "motherboard";
    	$component->component_type = 1;
    	$component->warranty_id = 1;
    	$component->status = "Available";

    	$component->save();



    }
}
