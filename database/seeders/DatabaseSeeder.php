<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::factory(1)->create();
        \App\Models\User::factory(10)->create();
        \App\Models\Team::factory(6)->create();
        \App\Models\Product::factory(200)->create();

    }
}
