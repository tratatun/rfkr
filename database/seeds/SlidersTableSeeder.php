<?php

use Illuminate\Database\Seeder;

class SlidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            DB::table('sliders')->insert([
                'title' => 'Завершен ремонт фасада строений по улице пр. Кирова',
                'text' => 'Если для простоты пренебречь потерями на теплопроводность, то видно, что темная материя едва ли квантуема. Вселенная заряжает внутримолекулярный газ, в итоге возможно появление обратной связи и самовозбуждение системы.',
                'img' => '/assets/images/main-carousel/slide-01.jpg',
                'user_id' => 1,
                'updated_user_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }

    }
}
