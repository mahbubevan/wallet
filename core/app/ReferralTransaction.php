<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReferralTransaction extends Model
{
    use SoftDeletes;

    const ON_SIGNUP_BONUS = 10;
    const ON_MONEY_SEND_BONUS = 5;

    const ON_SIGNUP_STATUS = 0;
    const ON_MONEY_SEND_STATUS = 1;

    protected $dates = ['deleted_at'];
    protected $fillable = ['id','transaction_by','user_id','bonus_amount','status','trax_id'];

    
    public function sender()
    {
        return $this->belongsTo(User::class,'transaction_by','id');
    }

    public function benefit_user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
