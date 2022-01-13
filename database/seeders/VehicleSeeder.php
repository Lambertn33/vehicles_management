<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('vehicles')->delete();

      \DB::table('vehicles')->insert(array(
          0 =>
          array(
              'id'=>'78c92664-fe64-498d-8ce9-9604f53922be',
              'type_id'=>'598c73ea-daf3-4b44-a21e-37691fc0c108',
              'category_id'=>'2679f0c4-6a28-4d39-8c65-b931eba0debe',
              'department_id'=>'923ba988-211d-4710-8d8d-b8f54795d26d',
              'driver_id'=>'2d15ae69-349e-4234-b081-e8c6611a1c3c',
              'brand'=>'TVS Brand 1',
              'model'=>'TVS Model 1',
              'plate_no'=>'RAB 656T',
              'acquisition_date'=>date('Y-m-d'),
              'created_at'=>now(),
              'updated_at'=>now()
          ),
          1 =>
          array(
              'id'=>'88165d30-3ca9-474f-bd71-801518a49727',
              'type_id'=>'598c73ea-daf3-4b44-a21e-37691fc0c108',
              'category_id'=>'2679f0c4-6a28-4d39-8c65-b931eba0debe',
              'department_id'=>'923ba988-211d-4710-8d8d-b8f54795d26d',
              'driver_id'=>'5e951ac1-2f15-40f0-aaf5-d9c8bd64cb1b',
              'brand'=>'TVS Brand 2',
              'model'=>'TVS Model 2',
              'plate_no'=>'RAB 656B',
              'acquisition_date'=>date('Y-m-d'),
              'created_at'=>now(),
              'updated_at'=>now()
          ),
          2 =>
          array(
              'id'=>'dbfe3944-7a65-4869-a854-9c7108bb19cc',
              'type_id'=>'4fe241a8-7be6-4833-8308-085bd52b57ab',
              'category_id'=>'2d41b6c3-aedf-46d7-8914-8e50a45879f1',
              'department_id'=>'923ba988-211d-4710-8d8d-b8f54795d26d',
              'driver_id'=>'77b48193-1641-4dd1-b19b-bc7d92f51df7',
              'brand'=>'VAN Brand 1',
              'model'=>'VAN Model 1',
              'plate_no'=>'RAB 658A',
              'acquisition_date'=>date('Y-m-d'),
              'created_at'=>now(),
              'updated_at'=>now()
          ),
      ));
    }
}
