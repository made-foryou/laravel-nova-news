<?php

namespace MennoTempelaar\NovaNewsTool\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;
use MennoTempelaar\NovaNewsTool\Models\Post;


/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{

    /**
     * @inheritdoc
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape( [
        'title'          => "string",
        'image'          => "string",
        'contents'       => "string",
        'hidden'         => "boolean",
        'published_at'   => "\DateTime",
        'published_till' => "\DateTime",
    ] )] public function definition (): array
    {

        return [
            'title'          => $this->faker->sentence(4, false),
            'image'          => $this->faker->image,
            'contents'       => $this->faker->text,
            'hidden'         => $this->faker->boolean,
            'published_at'   => $this->faker->dateTime,
            'published_till' => $this->faker->dateTime,
        ];
    }

}
