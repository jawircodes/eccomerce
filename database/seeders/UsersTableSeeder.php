<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            //Admin
            [
                'full_name' => 'Adipati Admin',
                'username'=> 'Admin',
                'email'=> 'admin@gmail.com',
                'password'=> Hash::make('12345'),
                'role'=>'admin',
                'status'=>'active'
            ]);
            //Vendor
        DB::table('users')->insert([
                'full_name' => 'Adipati Vendor',
                'username'=> 'Vendor',
                'email'=> 'vendor@gmail.com',
                'password'=> Hash::make('12345'),
                'role'=>'vendor',
                'status'=>'active'
            ]);
            //Customer
        DB::table('users')->insert([
                'full_name' => 'Adipati Customer',
                'username'=> 'Customer',
                'email'=> 'customer@gmail.com',
                'password'=> Hash::make('12345'),
                'role'=>'customer',
                'status'=>'active'
        ]);
    }
}
