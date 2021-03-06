<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            'status' => 'shown',
            'title' => 'О фонде',
            'url' => 'o-fonde',
            'text' => 'О фонде',
            'user_id' => 1,
            'updated_user_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'status' => 'shown',
            'title' => 'Программа',
            'url' => 'programma',
            'text' => 'Программа',
            'user_id' => 1,
            'updated_user_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'status' => 'shown',
            'title' => 'Деятельность фонда',
            'url' => 'deyatelnost-fonda',
            'text' => 'Деятельность фонда',
            'user_id' => 1,
            'updated_user_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'status' => 'shown',
            'title' => 'Собственникам',
            'url' => 'sobstvennikam',
            'text' => 'Собственникам',
            'user_id' => 1,
            'updated_user_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'status' => 'shown',
            'title' => 'Цели и задачи',
            'url' => 'tseli-i-zadachi',
            'text' => 'Цели и задачи',
            'user_id' => 1,
            'updated_user_id' => 1,
            'page_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'status' => 'shown',
            'title' => 'Уставные документы',
            'url' => 'ustavnye-dokumenty',
            'text' => 'Уставные документы',
            'user_id' => 1,
            'updated_user_id' => 1,
            'page_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'status' => 'shown',
            'title' => 'Правовая база',
            'url' => 'pravovaya-baza',
            'text' => 'Правовая база',
            'user_id' => 1,
            'updated_user_id' => 1,
            'page_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'status' => 'shown',
            'title' => 'Попечительский совет',
            'url' => 'popechitelskij-sovet',
            'text' => 'Попечительский совет',
            'user_id' => 1,
            'updated_user_id' => 1,
            'page_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'status' => 'shown',
            'title' => 'Общественный совет',
            'url' => 'obschestvennyj-sovet',
            'text' => 'Общественный совет',
            'user_id' => 1,
            'updated_user_id' => 1,
            'page_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'status' => 'shown',
            'title' => 'Руководство',
            'url' => 'rukovodstvo',
            'text' => 'Руководство',
            'user_id' => 1,
            'updated_user_id' => 1,
            'page_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'status' => 'shown',
            'title' => 'Научно-технический совет',
            'url' => 'nauchno-tehnicheskij-sovet',
            'text' => 'Научно-технический совет',
            'user_id' => 1,
            'updated_user_id' => 1,
            'page_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'status' => 'shown',
            'title' => 'Краткосрочный план',
            'url' => 'kratkosrochnyj-plan',
            'text' => 'Краткосрочный план',
            'user_id' => 1,
            'updated_user_id' => 1,
            'page_id' => 2,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'status' => 'shown',
            'title' => 'Региональная программа',
            'url' => 'regionalnaya-programma',
            'text' => 'Региональная программа',
            'user_id' => 1,
            'updated_user_id' => 1,
            'page_id' => 2,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'status' => 'shown',
            'title' => 'Ход выполнения программы',
            'url' => 'hod-vypolneniya-programmy',
            'text' => 'Ход выполнения программы',
            'user_id' => 1,
            'updated_user_id' => 1,
            'page_id' => 2,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'status' => 'shown',
            'title' => 'Новости программы',
            'url' => 'novosti-programmy',
            'text' => 'Новости программы',
            'user_id' => 1,
            'updated_user_id' => 1,
            'page_id' => 2,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'status' => 'shown',
            'title' => 'Торги и закупки',
            'url' => 'torgi-i-zakupki',
            'text' => 'Торги и закупки',
            'user_id' => 1,
            'updated_user_id' => 1,
            'page_id' => 3,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'status' => 'shown',
            'title' => 'Отчетность',
            'url' => 'otchetnost',
            'text' => 'Отчетность',
            'user_id' => 1,
            'updated_user_id' => 1,
            'page_id' => 3,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'status' => 'shown',
            'title' => 'Результаты работы',
            'url' => 'rezultaty-raboty',
            'text' => 'Результаты работы',
            'user_id' => 1,
            'updated_user_id' => 1,
            'page_id' => 3,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);


        DB::table('pages')->insert([
            'status' => 'shown',
            'title' => 'Новости фонда',
            'url' => 'novosti-fonda',
            'text' => 'Новости фонда',
            'user_id' => 1,
            'updated_user_id' => 1,
            'page_id' => 4,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'status' => 'shown',
            'title' => 'Информационные материалы',
            'url' => 'informatsionnye-materialy',
            'text' => 'Информационные материалы',
            'user_id' => 1,
            'updated_user_id' => 1,
            'page_id' => 4,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'status' => 'shown',
            'title' => 'В помощь собственнику',
            'url' => 'v-pomosch-sobstvenniku',
            'text' => 'В помощь собственнику',
            'user_id' => 1,
            'updated_user_id' => 1,
            'page_id' => 4,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'status' => 'shown',
            'title' => 'Образцы документов',
            'url' => 'obraztsy-dokumentov',
            'text' => 'Образцы документов',
            'user_id' => 1,
            'updated_user_id' => 1,
            'page_id' => 4,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'status' => 'shown',
            'title' => 'Часто задаваемые вопросы',
            'url' => 'chasto-zadavaemye-voprosy',
            'text' => 'Часто задаваемые вопросы',
            'user_id' => 1,
            'updated_user_id' => 1,
            'page_id' => 4,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'status' => 'shown',
            'title' => 'Юридическим лицам',
            'url' => 'yuridicheskim-litsam',
            'text' => 'Юридическим лицам',
            'user_id' => 1,
            'updated_user_id' => 1,
            'page_id' => 4,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'status' => 'shown',
            'title' => 'Форма обращения',
            'url' => 'forma-obrascheniya',
            'text' => 'Форма обращения',
            'user_id' => 1,
            'updated_user_id' => 1,
            'page_id' => 4,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
