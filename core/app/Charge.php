<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Charge extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['fixed_charge','percent_charge','interest_rate','on_signup_bonus','on_money_send_bonus','on_signup_ref_bonus','set_currency'];

    const FIXED_CHARGE = 2;
    const PERCENT_CHARGE = 5;
    const INTEREST_RATE = 10;
    const ON_SIGNUP_BONUS = 10;
    const ON_MONEY_SEND_BONUS = 5;
    const ON_SIGNUP_REFERENCE_BONUS =10;
}
