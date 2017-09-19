<?php

use Illuminate\Database\Seeder;

class CoversTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('covers')->insert([
            'title' => 'Программа капитального ремонта',
            'text' => 'Вы можете узнать, участвует ли Ваш дом в программе капитального ремонта<br>Проверить начисления<br>Узнать сроки и направления капитального ремонта',
            'img' => '/assets/images/main-carousel/slide-01.jpg',
            'user_id' => 1,
            'updated_user_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('covers')->insert([
            'title' => 'Программа капитального ремонта',
            'text' => 'Вы можете узнать, участвует ли Ваш дом в программе капитального ремонта<br>Проверить начисления<br>Узнать сроки и направления капитального ремонта',
            'img' => '/assets/images/main-carousel/slide-02.jpg',
            'user_id' => 1,
            'updated_user_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}