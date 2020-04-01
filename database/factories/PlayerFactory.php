<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\models\admin\Player;
use Faker\Generator as Faker;

$factory->define(Player::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'surname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt(123456789),
    ];
});
