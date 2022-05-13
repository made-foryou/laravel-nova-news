<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use MennoTempelaar\NovaNewsTool\Models\Post;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Post::factory(10)->create();
    }
}
