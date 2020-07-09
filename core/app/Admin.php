<?php

namespace App;

use App\Http\Controllers\InterestTransactionController;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\InterestTransaction;

class Admin extends Authenticatable
{
    protected $guarded = ['id'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function interest_transactions()
    {
        return $this->hasMany(InterestTransaction::class);
    }
}
