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
        DB::table('users')->where('email', 'masadi.com@gmail.com')->delete();

        DB::table('users')->insert([
            'name' => 'Achmadi',
            'email' => 'masadi.com@gmail.com',
            'password' => bcrypt('himalaya'),
            'type' => 'admin',
        ]);
    }
}
