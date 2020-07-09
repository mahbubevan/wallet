<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username','referenced_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function interest_transactions()
    {
        return $this->hasMany(InterestTransaction::class)->orderBy('created_at','desc');
    }

    public function bonus_from_transactions()
    {
        return $this->hasMany(ReferralTransaction::class);
    }

    public function referred_by()
    {
        return $this->belongsTo(User::class, 'referenced_by');
    }

    // public function referred_to()
    // {
    //     return $this->hasMany(User::class,'id','reference_by');
    // }


    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function rcv_transactions()
    {
        return $this->hasMany(Transaction::class,'rcvr','id');
    }


    public function master_transactions()
    {
        return $this->hasMany(MasterTransaction::class);
    }
    
}
