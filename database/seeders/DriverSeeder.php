<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('drivers')->delete();

        \DB::table('drivers')->insert(array(
            0 =>array(
                'id'=>'2d15ae69-349e-4234-b081-e8c6611a1c3c',
                'names'=>'Driver 1',
                'is_occupied'=>true,
                'created_at'=>now(),
                'updated_at'=>now()
            ),
            1 =>array(
                'id'=>'5e951ac1-2f15-40f0-aaf5-d9c8bd64cb1b',
                'names'=>'Driver 2',
                'is_occupied'=>true,
                'created_at'=>now(),
                'updated_at'=>now()
            ),
            2 =>array(
                'id'=>'77b48193-1641-4dd1-b19b-bc7d92f51df7',
                'names'=>'Driver 3',
                'is_occupied'=>true,
                'created_at'=>now(),
                'updated_at'=>now()
            ),
            3 =>array(
                'id'=>'d7968ebd-ebbc-4a8c-8c69-c4056bdc1a25',
                'names'=>'Driver 4',
                'is_occupied'=>false,
                'created_at'=>now(),
                'updated_at'=>now()
            ),
            4 =>array(
                'id'=>'e39d08e6-ca39-46c7-8c54-e11cbef66f23',
                'names'=>'Driver 5',
                'is_occupied'=>false,
                'created_at'=>now(),
                'updated_at'=>now()
            ),
        ));
    }
}
