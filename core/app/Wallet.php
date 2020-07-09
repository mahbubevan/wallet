<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{
    use SoftDeletes;

    const SIGNUP_BALANCE = 50;
    const PREV_BALANCE = 0;

    protected $dates = ['deleted_at'];
    protected $fillable = ['user_id','current_balance','prev_balance'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
