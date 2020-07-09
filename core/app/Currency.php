<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guard = ['id'];
    protected $fillable = ['currency'];

    const BDT = 'taka';
    const DOLLER = 'doller';
    const INR = 'ruppee';
}
