<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    const SEEN = 1;
    const UNSEEN = 0;

    protected $fillable = ['description','status'];
}
