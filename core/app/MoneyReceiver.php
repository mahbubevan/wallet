<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoneyReceiver extends User
{
    public function rcv_transactions()
    {
        return $this->hasMany(Transaction::class, 'rcvr');
    }
}
