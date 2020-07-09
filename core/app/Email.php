<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    // use SoftDeletes;

    const SEEN = 1;
    const UNSEEN = 0;
    
    protected $dates = ['deleted_at'];
    protected $fillable = ['from','subject','body','name'];
}
