<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name'=>'SuperAdmin',
                'created_at'=>new DateTime(),
                'updated_at'=>new DateTime(),
            ],
            [
                'name'=>'Admin',
                'created_at'=>new DateTime(),
                'updated_at'=>new DateTime(),
            ],
            [
                'name'=>'User',
                'created_at'=>new DateTime(),
                'updated_at'=>new DateTime(),
            ],
        ]);
    }
}
