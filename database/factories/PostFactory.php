<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        Post::TITLE=>$faker->sentence(5),
        Post::CONTENT=>$faker->paragraph(4,true),
        Post::PRIMARY_IMAGE=>$faker->imageUrl(),
        Post::THUMBNAIL_IMAGE=>$faker->imageUrl(),
        Post::SLUG=>$faker->slug,
        Post::AUTHOR=>$faker->name
    ];
});
