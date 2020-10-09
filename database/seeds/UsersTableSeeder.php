<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->whereIn('email', ['masadi.com@gmail.com', 'ibnuadkarim@gmail.com'])->delete();

        DB::table('users')->insert([
            'name' => 'Achmadi',
            'email' => 'masadi.com@gmail.com',
            'password' => bcrypt('himalaya'),
            'type' => 'admin',
        ]);
        DB::table('users')->insert([
            'name' => 'SAHRONI',
            'email' => 'ibnuadkarim@gmail.com',
            'password' => bcrypt('iksaba0k'),
            'type' => 'admin',
        ]);
    }
}
