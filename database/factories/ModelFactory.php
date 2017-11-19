<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return  [
        'name'=> $faker->name,
        'email'=>$faker->unique()->safeEmail,
        'password'=>$password?:$password=bcrypt('secret'),
        'remember_token'=>str_random(10),

    ];
});
$factory->define(App\Product::class, function (Faker $faker) {

    return  [
        'name'=> $faker->sentence(3),
        'category_id'=>1,
        'price'=>$faker->numberBetween(100,10000),
        'description'=>$faker->paragraph(4),
        'image'=>'/storage/cover_images/myheroacademia_tshirt_1.jpg',
        'Seller_id'=>1,
        'code'=>'hero academia'

    ];
});

