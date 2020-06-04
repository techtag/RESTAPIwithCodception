<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence(5),
        'content'=>$faker->paragraph(4,true),
        'primary_image'=>$faker->imageUrl(),
        'thumbnail_image'=>$faker->imageUrl(),
        'slug'=>$faker->sentence(5),
        'author'=>$faker->name
    ];
});
