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

    	$warranty->brand_id = 1;
    	$warranty->purchase_date = Carbon\Carbon::now();
    	$warranty->purchase_location = 'las vegas';
    	$warranty->receipt_url = 'helloworld';
    	$warranty->serial_no = '1231312';
    	$warranty->warranty_life = Carbon\Carbon::now();

    	$warranty->save();

        $componentNames = ["Motherboard", "CPU", "GPU", "RAM", "Storage"];

        for( $ind = 1; $ind <= 5; $ind++ ){

            $component = new App\Component;
        	$component->asset_tag = "COMP-".$ind;
        	$component->component_name = $componentNames[$ind - 1];
        	$component->component_type_id = $ind;
        	$component->save();
		}
		
		factory( App\Department::class, 5 )->create();
		factory( App\Employee::class, 12 )->create();
		factory(App\Peripheral::class, 12)->create();
		factory(App\Computer::class, 12)->create();
		factory(App\Component::class, 12)->create();


    }
}
