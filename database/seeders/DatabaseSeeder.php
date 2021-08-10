<?php

namespace Database\Seeders;

use App\Models\Authors;
use App\Models\Books;
use App\Models\PublishingHouses;
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
        PublishingHouses::factory(3)->create();
        Authors::factory(2)->create();
        Books::factory(10)->create();
    }
}
