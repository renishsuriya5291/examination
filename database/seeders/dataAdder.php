<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class dataAdder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('admins')->insert([
            'email' => 'demo@gmail.com',
            'password' => 'demo'
        ]);
        DB::table('super_admins')->insert([
            'email' => 'demo@gmail.com',
            'password' => 'demo'
        ]);
        DB::table('teachers')->insert([
            'fullname' => 'David Brooks',
            'phone' => '2228883337',
            'email' => 'david@gmail.com'
        ]);
    }
}
