<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Bondgenoot\NovaNewsTool\Models\PostModel;
use Orchestra\Testbench\Factories\UserFactory;

uses(RefreshDatabase::class);

it('associates the active user to the post', function () {
    $user = ( new UserFactory() )->create();

    actingAs($user);

    /** @var PostModel $post */
    $post = PostModel::factory()->create();

    expect($post->createdBy->id)->toBe($user->id);
});
