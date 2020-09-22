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
        $pc_types = [ "Desktop", "Laptop" ];
        $os = ["Windows", "Mac", "Linux", "ChromeOS" ];

    	foreach( $component_types as $type ){
    		DB::table('component_types')->insert(
				[ 'component_type' => $type ],
			);
    	}

        foreach( $pc_types as $type ){
            DB::table('computer_types')->insert(
                [ 'computer_type' => $type ],
            );
        }

        foreach( $os as $operatingSystem ){
            DB::table('operating_systems')->insert(
                [ 'name' => $operatingSystem ],
            );
        }

    }
}
