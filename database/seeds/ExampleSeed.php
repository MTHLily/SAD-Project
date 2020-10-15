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

		$componentNames = ["ASUS ProArt Z490-CREATOR 10G	", "Intel® Core™ i7-9700K Processor", "GEFORCE RTX 2070	", "Corsair Vengeance LPX 8GB 3200MHz	", "870 QVO SATA III 2.5\" SSD 2TB"];
		$peripheralNames = [ 'ASUS Monitor', 'Genius Keyboard', 'Logitech Mouse', 'iPhone 6', 'iPad Pro', 'Generic AVR' ];

        for( $ind = 1; $ind <= 5; $ind++ ){

            $component = new App\Component;
        	$component->asset_tag = "COMPONENT-".$ind;
        	$component->component_name = $componentNames[$ind - 1];
        	$component->component_type_id = $ind;
        	$component->save();
		}

		foreach ( \App\PeripheralType::all() as $key => $type ) {
			$peri = new App\Peripheral;
			$peri->asset_tag = "PERIPHERAL-".( $key + 1 );
			$peri->peripheral_name = $peripheralNames[$key];
			$peri->peripheral_type = $type->id;
			$peri->save();
		}

		DB::table('users')->insert([
			'name' => 'Mike',
			'email' => 'a@a.com',
			'password' => Hash::make('admin'),
		]);
		
		factory( App\Department::class, 5 )->create();
		factory( App\Employee::class, 12 )->create();
		// factory(App\Peripheral::class, 12)->create();
		// factory(App\Computer::class, 12)->create();
		// factory(App\Component::class, 12)->create();


    }
}
