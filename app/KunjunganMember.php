<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ColumnFilterer;

class KunjunganMember extends Model
{
    use ColumnFilterer;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice',
        'kode_member',
        'member_id'
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        //
    ];
}
