<?php

use Illuminate\Database\Seeder;

class GovResourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gov_resources')->insert([
            'title' => 'Минстрой Российской Федераци',
            'url' => 'minstroyrf.ru/',
            'user_id' => 1,
            'updated_user_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('gov_resources')->insert([
            'title' => 'Правительство Республики Крым',
            'url' => 'http://rk.gov.ru/',
            'user_id' => 1,
            'updated_user_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('gov_resources')->insert([
            'title' => 'Министерство Жилищно-Коммунального Хозяйства Республики Крым',
            'url' => 'minstroyrf.ru',
            'user_id' => 1,
            'updated_user_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('gov_resources')->insert([
            'title' => 'Государственная корпорация – Фонд Содействия Реформированию ЖКХ',
            'url' => 'minstroyrf.ru',
            'user_id' => 1,
            'updated_user_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
