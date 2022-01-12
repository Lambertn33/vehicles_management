<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       \DB::table('departments')->delete();

       \DB::table('departments')->insert(array(
        0 =>
        array(
            'id'=>'923ba988-211d-4710-8d8d-b8f54795d26d',
            'name'=>'Department 1',
            'created_at'=>now(),
            'updated_at'=>now()
        ),
        1 =>
        array(
            'id'=>'b5de0add-a6e5-41a2-a1f7-08c2e8f5029d',
            'name'=>'Department 2',
            'created_at'=>now(),
            'updated_at'=>now()
        )
    ));
    }
}
