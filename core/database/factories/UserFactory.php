<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use App\Charge;
use App\Currency;
use App\InterestTransaction;
use App\Profile;
use App\Reference;
use App\ReferralTransaction;
use App\Transaction;
use App\User;
use App\Wallet;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'username' => $user = $faker->unique()->userName,
        'referenced_by' => null,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('user'), // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->unique()->userName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('admin'), // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Wallet::class, function (Faker $faker) {
    return [
        'user_id' => $faker->unique()->numberBetween(1, User::count()),
        'current_balance' => $faker->numberBetween(5000, 10000),
        'prev_balance' => $faker->numberBetween(5000, 10000),
    ];
});

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'user_id' => $faker->unique()->numberBetween(1, User::count()),
    ];
});

$factory->define(Currency::class, function (Faker $faker) {
    return [
        'currency' => Currency::BDT,
    ];
});

$factory->define(Charge::class, function (Faker $faker) {
    return [
        'fixed_charge' => Charge::FIXED_CHARGE,
        'percent_charge' => Charge::PERCENT_CHARGE,
        'interest_rate' => Charge::INTEREST_RATE,
        'on_signup_bonus' => Charge::ON_SIGNUP_BONUS,
        'on_money_send_bonus' => Charge::ON_MONEY_SEND_BONUS,
        'set_currency' => Currency::BDT,
    ];
});

// $factory->define(Reference::class, function (Faker $faker) {
//     return [
//         'user_id' => $user = User::all()->random()->id,
//         'referenced_by' => array_rand(User::all()->except($user)->toArray(), 1),
//     ];
// });

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'user_id' => $user = User::all()->random()->id,
        'rcvr' => User::all()->except($user)->random()->id,
        'amount' => $faker->numberBetween(500,1000),
        'charge' => $faker->randomElement([Charge::FIXED_CHARGE, Charge::PERCENT_CHARGE]),
    ];
});

$factory->define(InterestTransaction::class, function (Faker $faker) {
    return [
        'user_id' =>  $faker->unique()->numberBetween(1, User::count()),
        'admin_id' => 1,
        'interest_rate' => Charge::INTEREST_RATE,
    ];
});



$factory->define(ReferralTransaction::class, function (Faker $faker) {
    return [
        'transaction_by' => $user = User::all()->random()->id,
        'user_id' =>
        User::where('id', $user)->first()->referenced_by,
        'bonus_amount' => $faker->randomElement([ReferralTransaction::ON_MONEY_SEND_BONUS, ReferralTransaction::ON_SIGNUP_BONUS]),
        'status' => $faker->randomElement([ReferralTransaction::ON_MONEY_SEND_STATUS, ReferralTransaction::ON_SIGNUP_STATUS])
    ];
});
