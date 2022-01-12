<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();

        \DB::table('users')->insert(array(
           'id'=>'7102d08c-bf2e-4648-aecc-e1d88acbbd65',
           'names'=>'Administrator',
           'email'=>'admin@gmail.com',
           'password'=>Hash::make('admin12345'),
           'created_at'=>now(),
           'updated_at'=>now()
        ));
    }
}
