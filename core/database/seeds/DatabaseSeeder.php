<?php

use App\Admin;
use App\Charge;
use App\Currency;
use App\InterestTransaction;
use App\MasterTransaction;
use App\Profile;
use App\Reference;
use App\ReferralTransaction;
use App\Transaction;
use App\User;
use App\Wallet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        // User::truncate();
        // Wallet::truncate();
        // Profile::truncate();
        // MasterTransaction::truncate();
        // ReferralTransaction::truncate();
        // InterestTransaction::truncate();

        // factory(User::class,100)->create();
        // factory(Admin::class, 2)->create();
        // factory(Profile::class,100)->create();
        // factory(Wallet::class,100)->create();

        // factory(Currency::class, 1)->create();
        // factory(Charge::class, 1)->create();
        // factory(Transaction::class,30)->create();
        // factory(InterestTransaction::class,10)->create();
        // factory(ReferralTransaction::class, 15)->create();
    }
}
