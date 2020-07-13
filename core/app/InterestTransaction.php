<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InterestTransaction extends Model
{
    use SoftDeletes;

    const INTEREST_RATE = 10;

    protected $dates = ['deleted_at'];
    protected $fillable = ['user_id','admin_id','interest_rate','amount','trax_id','bonus'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
