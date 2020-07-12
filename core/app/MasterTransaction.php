<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterTransaction extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'trax_id','user_id','amount',
        'charge','current_balance',
        'remarks','status'];

    protected $appends = ['user_name'];
    // protected $dateFormat = 'Y-m-d';

    const DEBITED = 0;
    const CREDITED = 1;
    const DEBITED_BY_ADMIN = 2;
    const CREDITED_BY_ADMIN = 3;


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserNameAttribute()
    {
        return $this->user->name;
    }

    protected $casts = [
        'created_at' => 'datetime:w F y H:i a',
    ];

    // public function getCreatedAtAttribute()
    // {
    //     return $this->
    // }
}
