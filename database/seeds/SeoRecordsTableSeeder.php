<?php

use Illuminate\Database\Seeder;

class SeoRecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('seo_records')->insert([
                'title' => 'Присоединение к ЕИРЦ',
                'text' => 'НО РФ КРМД РК присоединился к системе <a href="/">ЕИРЦ</a>. Появиласьвозможность контроля платежей с помощью <a href="/">Личного Кабинета</a>',
                'user_id' => 1,
                'updated_user_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
