<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(PagesTableSeeder::class);
         $this->call(NewsTableSeeder::class);
         $this->call(GovResourcesTableSeeder::class);
         $this->call(CoversTableSeeder::class);
         $this->call(SeoRecordsTableSeeder::class);
         $this->call(SlidersTableSeeder::class);
    }
}
