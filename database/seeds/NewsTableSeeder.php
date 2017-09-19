<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        function create() {
            DB::table('news')->insert([
                'title' => '«ЗВЕЗДА»: Вовремя платить за капремонт выгодно. На должников будут подавать в суд',
                'url' => 'vovremya-platit-za-kapremont-vygodno-' . microtime(),
                'text' => '«ЗВЕЗДА»: Вовремя платить за капремонт выгодно. На должников будут подавать в суд',
                'user_id' => 1,
                'updated_user_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);

            DB::table('news')->insert([
                'title' => 'Застрахована ответственность подрядчиков в случае ущерба, нанесенного жизни, здоровью и имуществу жителей многоквартирных домов',
                'url' => 'zastrahovana-otvetstvennost-podryadchikov-' . microtime(),
                'text' => 'Застрахована ответственность подрядчиков в случае ущерба,
                            нанесенного жизни, здоровью и имуществу жителей многоквартирных домов',
                'user_id' => 1,
                'updated_user_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);

            DB::table('news')->insert([
                'title' => 'Разработано приложение «Помощник ЭКР» – для расчета прогнозируемого
                            экономического эффекта при проведении капитального ремонта',
                'url' => 'razrabotano-prilozhenie-pomoschnik-ekr-' . microtime(),
                'text' => 'Разработано приложение «Помощник ЭКР» – для расчета прогнозируемого
                            экономического эффекта при проведении капитального ремонта',
                'user_id' => 1,
                'updated_user_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }

        for ($i = 0; $i < 3; $i++) {
            create();
        }

    }
}
