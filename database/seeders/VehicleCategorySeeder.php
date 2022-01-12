<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VehicleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('vehicle_categories')->delete();
        
        \DB::table('vehicle_categories')->insert(array(
          //CARS
           0 =>array(
               'id' =>'2d41b6c3-aedf-46d7-8914-8e50a45879f1',
               'type_id'=>'4fe241a8-7be6-4833-8308-085bd52b57ab',
               'name'=>'VAN',
               'created_at'=>now(),
               'updated_at'=>now()
           ),
           1 =>array(
               'id' =>'c7e3a7c5-3ecf-4e2f-b315-16028711b527',
               'type_id'=>'4fe241a8-7be6-4833-8308-085bd52b57ab',
               'name'=>'BUS',
               'created_at'=>now(),
               'updated_at'=>now()
           ),
           2 =>array(
               'id' =>'99f1d5d5-c74d-4b30-8f1c-b092129f3f3e',
               'type_id'=>'4fe241a8-7be6-4833-8308-085bd52b57ab',
               'name'=>'TRUCK',
               'created_at'=>now(),
               'updated_at'=>now()
           ),
           //BIKES
           3 =>array(
               'id' =>'2679f0c4-6a28-4d39-8c65-b931eba0debe',
               'type_id'=>'598c73ea-daf3-4b44-a21e-37691fc0c108',
               'name'=>'TVS',
               'created_at'=>now(),
               'updated_at'=>now()
           ),
           4 =>array(
               'id' =>'42004b49-9660-4a97-92cc-49e72d435f5d',
               'type_id'=>'598c73ea-daf3-4b44-a21e-37691fc0c108',
               'name'=>'HONDA',
               'created_at'=>now(),
               'updated_at'=>now()
           ),
        ));
    }
}
