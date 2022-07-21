<?php

namespace Bondgenoot\NovaNewsTool\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;
use Bondgenoot\NovaNewsTool\Models\PostModel;

/**
 * @extends Factory<PostModel>
 */
class PostFactory extends Factory
{
    /**
     * {@inheritdoc}
     */
    protected $model = PostModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['title' => 'string',
        'image' => 'string',
        'hidden' => 'bool',
        'published_at' => "\DateTime",
        'published_till' => "\DateTime",
    ])]
 public function definition(): array
 {
     return [
         'title' => $this->faker->sentence(4, false),
         'image' => $this->faker->image,
         'hidden' => $this->faker->boolean,
         'published_at' => $this->faker->dateTime,
         'published_till' => $this->faker->dateTime,
     ];
 }
}
