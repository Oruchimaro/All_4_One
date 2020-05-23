<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Blog\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->word(2);
    $slug =  Str::slug($title);

    return [
        'title' => $title,
        'slug' => $slug,
        'body' => $faker->sentence(2500),
        'author_id' => $faker->numberBetween(1, 5),
        'category_id' => $faker->numberBetween(1, 10),
        'seo_title' => 'test seo title',
        'cover_img' => 'images/covers/default.jpeg',
        'status' => 'PUBLISHED'
    ];
});
