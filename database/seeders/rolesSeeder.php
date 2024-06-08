<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class rolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['id' => '1', 'name' => 'Customer', 'description' => 'This is general User'],
            ['id' => '2', 'name' => 'Salesman', 'description' => 'This is membership user'],
            ['id' => '102', 'name' => 'Admin', 'description' => 'This is special user'],
        ]);
    }
}
