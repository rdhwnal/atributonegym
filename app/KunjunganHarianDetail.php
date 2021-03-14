<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KunjunganHarianDetail extends Model
{
    protected $table = 'kunjungan_harian_details';

    protected $guarded = [];

    public function kategori_kunjungan_harian()
    {
        return $this->belongsTo('App\KategoriKunjunganHarian');
    }

    public function kunjungan_harian()
    {
        return $this->belongsTo('App\KunjunganHarian');
    }
}
