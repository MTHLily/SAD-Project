<?php

use Illuminate\Database\Seeder;

class StaticLookup extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$component_types = [ "Motherboard", "CPU", "GPU", "RAM", "Storage" ];

    	foreach( $component_types as $type ){
    		DB::table('component_types')->insert(
				[ 'component_type' => $type ],
			);
    	}
    }
}
