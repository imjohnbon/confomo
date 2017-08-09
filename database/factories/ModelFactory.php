<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'twitter_id' => $faker->randomNumber,
    ];
});

$factory->define(App\Conference::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence,
        'start_date' => $faker->date(),
        'end_date' => $faker->date(),
        'slug' => str_random(16),
    ];
});

$factory->define(App\Friend::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->word,
        'type' => 'new',
        'met' => false,
    ];
});

$factory->define(App\Tweeter::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'location' => $faker->address,
        'description' => $faker->sentence,
        'url' => $faker->url,
        'url_display' => $faker->url,
    ];
});
