<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\ColumnFilterer;

class Admin extends Authenticatable
{
    use Notifiable;
    use ColumnFilterer;

    protected $table = 'admins';

    protected $guard = 'admin';

    protected $guarded = [];

    protected $fillable = [
        'nama',
        'email',
        'no_telepon',
        'password',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
