<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;

    const ADDRESS = 'DEFAULT';
    const CITY = 'DEFAULT';
    const ZIP = 'DEFAULT';
    const NID = 'DEFAULT';
    const IMG = '/assets/img/default.jpg';

    protected $dates = ['deleted_at'];
    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
