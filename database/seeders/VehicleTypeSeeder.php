<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \DB::table('vehicle_types')->delete();

       \DB::table('vehicle_types')->insert(array(
           0 => 
           array(
               'id'=>'4fe241a8-7be6-4833-8308-085bd52b57ab',
               'name'=>'Car',
               'created_at'=>now(),
               'updated_at'=>now()
           ),
           1=>
           array(
               'id'=>'598c73ea-daf3-4b44-a21e-37691fc0c108',
               'name'=>'Bike',
               'created_at'=>now(),
               'updated_at'=>now()
           )
        ));
    }
}
