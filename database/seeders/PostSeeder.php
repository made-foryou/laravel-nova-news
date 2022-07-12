<?php

namespace MennoTempelaar\NovaNewsTool\Database\Seeders;

use Illuminate\Database\Seeder;
use MennoTempelaar\NovaNewsTool\Models\PostModel;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        PostModel::factory(10)->create();
    }
}
