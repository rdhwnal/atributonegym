<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Owner extends Authenticatable
{
    use Notifiable;

    protected $table = 'owners';

    protected $guard = 'owner';

    protected $guarded = [];

    // protected $fillable = [
    //     'nama',
    //     'email',
    //     'password',
    // ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
