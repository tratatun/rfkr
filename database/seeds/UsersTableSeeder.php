<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Админ Администратор',
            'email' => 'admin@rfkr.ru',
            'role' => 'superadmin',
            'password' => bcrypt('adminrfkr')
        ]);
    }
}
