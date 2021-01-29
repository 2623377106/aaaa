<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Article::class, function (Faker $faker) {
    return [
        //
        'title'=>$faker->title,
        'name'=>$faker->name,
        'desn'=>$faker->title,
        'body'=>$faker->text

    ];
});
