<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoneySender extends User
{
    public function send_transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
