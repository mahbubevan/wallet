<?php

use App\Charge;
use App\Currency;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charges', function (Blueprint $table) {
            $table->id();
            $table->double('fixed_charge')->default(Charge::FIXED_CHARGE);
            $table->double('percent_charge')->default(Charge::PERCENT_CHARGE);
            $table->double('interest_rate')->default(Charge::INTEREST_RATE);
            $table->double('on_signup_bonus')->default(Charge::ON_SIGNUP_BONUS);
            $table->double('on_money_send_bonus')->default(Charge::ON_MONEY_SEND_BONUS);
            $table->double('on_signup_ref_bonus')->default(Charge::ON_SIGNUP_REFERENCE_BONUS);
            $table->string('set_currency')->default(Currency::BDT);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charges');
    }
}
