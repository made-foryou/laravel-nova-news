<?php

namespace Bondgenoot\NovaNewsTool\Database\Factories;

use Bondgenoot\NovaNewsTool\Models\PostModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;
use Orchestra\Testbench\Factories\UserFactory;

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
    #[ArrayShape([
        'title' => 'string',
        'image' => 'string',
        'author_id' => 'integer',
        'hidden' => 'bool',
        'published_at' => "\DateTime",
        'published_till' => "\DateTime",
    ])]
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4, false),
            'image' => $this->faker->image,
            'author_id' => (new UserFactory)->create(),
            'hidden' => $this->faker->boolean,
            'published_at' => $this->faker->dateTime,
            'published_till' => $this->faker->dateTime,
        ];
    }
}
