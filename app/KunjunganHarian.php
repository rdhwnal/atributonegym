<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ColumnFilterer;

class KunjunganHarian extends Model
{
    use ColumnFilterer;

    protected $table = 'kunjungan_harians';

    protected $guarded = [];

    protected $dates = ['created_at'];

    public function kategori_kunjungan()
    {
        return $this->belongsTo('App\KategoriKunjunganHarian');
    }

    public function kunjungan_harian_details()
    {
        return $this->hasMany('App\KunjunganHarianDetail');
    }
}
