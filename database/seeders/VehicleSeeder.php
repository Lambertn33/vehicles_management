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
              'driver_id'=>'',
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
              'driver_id'=>'',
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
              'driver_id'=>'',
              'brand'=>'VAN Brand 1',
              'model'=>'VAN Model 1',
              'plate_no'=>'RAB 658A',
              'acquisition_date'=>date('Y-m-d'),
              'created_at'=>now(),
              'updated_at'=>now()
          ),
          3 =>
          array(
              'id'=>'aecc5fe9-c87e-40f4-8c0d-f5f42dae5d0a',
              'type_id'=>'4fe241a8-7be6-4833-8308-085bd52b57ab',
              'category_id'=>'2d41b6c3-aedf-46d7-8914-8e50a45879f1',
              'department_id'=>'923ba988-211d-4710-8d8d-b8f54795d26d',
              'driver_id'=>'',
              'brand'=>'VAN Brand 2',
              'model'=>'VAN Model 2',
              'plate_no'=>'RAB 658B',
              'acquisition_date'=>date('Y-m-d'),
              'created_at'=>now(),
              'updated_at'=>now()
          ),
          4 =>
          array(
              'id'=>'30e3032c-eab4-4298-a8f8-4c1375ac59d6',
              'type_id'=>'598c73ea-daf3-4b44-a21e-37691fc0c108',
              'category_id'=>'42004b49-9660-4a97-92cc-49e72d435f5d',
              'department_id'=>'923ba988-211d-4710-8d8d-b8f54795d26d',
              'driver_id'=>'',
              'brand'=>'HONDA Brand 1',
              'model'=>'HONDA Model 1',
              'plate_no'=>'RAC 918U',
              'acquisition_date'=>date('Y-m-d'),
              'created_at'=>now(),
              'updated_at'=>now()
          ),
          5 =>
          array(
              'id'=>'a72d1a2c-0a08-4a40-a5f2-de69503a9577',
              'type_id'=>'598c73ea-daf3-4b44-a21e-37691fc0c108',
              'category_id'=>'42004b49-9660-4a97-92cc-49e72d435f5d',
              'department_id'=>'923ba988-211d-4710-8d8d-b8f54795d26d',
              'driver_id'=>'',
              'brand'=>'HONDA Brand 2',
              'model'=>'HONDA Model 2',
              'plate_no'=>'RAC 918G',
              'acquisition_date'=>date('Y-m-d'),
              'created_at'=>now(),
              'updated_at'=>now()
          ),
          6 =>
          array(
              'id'=>'966d0200-3131-4801-8a78-b35853fa7911',
              'type_id'=>'4fe241a8-7be6-4833-8308-085bd52b57ab',
              'category_id'=>'99f1d5d5-c74d-4b30-8f1c-b092129f3f3e',
              'department_id'=>'923ba988-211d-4710-8d8d-b8f54795d26d',
              'driver_id'=>'',
              'brand'=>'TRUCK Brand 1',
              'model'=>'TRUCK Model 1',
              'plate_no'=>'RAC 918H',
              'acquisition_date'=>date('Y-m-d'),
              'created_at'=>now(),
              'updated_at'=>now()
          ),
          7 =>
          array(
              'id'=>'4224eca7-68ef-43e2-aa7b-669a071a69be',
              'type_id'=>'4fe241a8-7be6-4833-8308-085bd52b57ab',
              'category_id'=>'99f1d5d5-c74d-4b30-8f1c-b092129f3f3e',
              'department_id'=>'923ba988-211d-4710-8d8d-b8f54795d26d',
              'driver_id'=>'',
              'brand'=>'TRUCK Brand 2',
              'model'=>'TRUCK Model 2',
              'plate_no'=>'RAC 917Y',
              'acquisition_date'=>date('Y-m-d'),
              'created_at'=>now(),
              'updated_at'=>now()
          ),
          8 =>
          array(
              'id'=>'0e8e8363-51a6-41a7-9fd2-57397a18cf0d',
              'type_id'=>'4fe241a8-7be6-4833-8308-085bd52b57ab',
              'category_id'=>'c7e3a7c5-3ecf-4e2f-b315-16028711b527',
              'department_id'=>'923ba988-211d-4710-8d8d-b8f54795d26d',
              'driver_id'=>'',
              'brand'=>'BUS Brand 1',
              'model'=>'BUS Model 1',
              'plate_no'=>'RAC 917Y',
              'acquisition_date'=>date('Y-m-d'),
              'created_at'=>now(),
              'updated_at'=>now()
          ),
          9 =>
          array(
              'id'=>'a98d1ab6-b286-45f5-82f7-46f935143433',
              'type_id'=>'4fe241a8-7be6-4833-8308-085bd52b57ab',
              'category_id'=>'c7e3a7c5-3ecf-4e2f-b315-16028711b527',
              'department_id'=>'923ba988-211d-4710-8d8d-b8f54795d26d',
              'driver_id'=>'',
              'brand'=>'BUS Brand 1',
              'model'=>'BUS Model 1',
              'plate_no'=>'RAC 917T',
              'acquisition_date'=>date('Y-m-d'),
              'created_at'=>now(),
              'updated_at'=>now()
          ),
      ));
    }
}
