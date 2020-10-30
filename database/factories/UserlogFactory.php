<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Userlog;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'member_id' => User::all()->random()->id,
        'note' => $faker->realText($maxNbChars = 50, $indexSize = 2),
        'created_at' => $faker->dateTime($max = 'now', $timezone = null),
        'updated_at' => $faker->dateTime($max = 'now', $timezone = null)
    ];
});
