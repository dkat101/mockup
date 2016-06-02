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
    return array(
        'u_id' => $faker->uuid,
        'f_name' => $faker->firstName,
        'l_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => bcrypt($faker->password),
        'remember_token' => str_random(10)
    );
});

$factory->define(App\Project::class, function (Faker\Generator $faker) {
    return [
        'p_id' => $faker->uuid,
        'user_id' => $faker->numberBetween(1, 10),
        'name' => $faker->name,
        'description' => $faker->sentence()
    ];
});

$factory->define(App\Image::class, function (Faker\Generator $faker) {
    return [
        'i_id' => $faker->uuid,
        'project_id' => $faker->uuid,
        'display_name' => $faker->name,
        'file_name' => $faker->name,
        'links' => $faker->paragraph,
        'views' => $faker->numberBetween(1, 100)
    ];
});
