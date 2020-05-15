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
        'body'=>$faker->sentences(25),
        'author_id' => 1,
        'seo_title' => 'test seo title',
        'cover_img' => 'images/covers/default.jpeg',
        'status' => 'PUBLISHED'
    ];
});
