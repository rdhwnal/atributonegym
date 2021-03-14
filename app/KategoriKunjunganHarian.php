<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ColumnFilterer;

class KategoriKunjunganHarian extends Model
{
    use ColumnFilterer;

    protected $table = 'kategori_kunjungan_harians';

    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'harga',
    ];
}
