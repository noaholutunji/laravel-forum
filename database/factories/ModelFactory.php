<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Channel;
use App\Reply;
use App\Thread;
use Faker\Generator as Faker;
use Ramsey\Uuid\Uuid;

$factory->define(Thread::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'channel_id' => function () {
            return factory('App\Channel')->create()->id;
        },
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'visits' => 0
    ];
});

$factory->define(Channel::class, function (Faker $faker) {
    $name = $faker->word;

    return [
        'name' => $name,
        'slug'=> $name
    ];
});

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'thread_id' => function () {
            return factory('App\Thread')->create()->id;
        },
        'body' => $faker->paragraph
    ];
});

$factory->define(\Illuminate\Notifications\DatabaseNotification::class, function (Faker $faker) {
    return [
        'id' => Uuid::uuid4()->toString(),
        'type' => 'App\Notifications\ThreadWasUpdated',
        'notifiable_id' => function () {
            return auth()->id() ?: factory('App\User')->create()->id;
        },
        'notifiable_type' => 'App\User',
        'data' => ['foo' => 'bar']
    ];
});
