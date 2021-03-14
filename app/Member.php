<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ColumnFilterer;

class Member extends Model
{
    use ColumnFilterer;

    protected $table = 'members';

    protected $guarded = [];

    protected $fillable = [
        'kode_member',
        'nama',
        'email',
        'no_telepon',
        'jenis_kelamin',
        'alamat',
        'tanggal_mulai',
        'tanggal_akhir',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'status'
    ];

    /**
     * Get the total order.
     *
     * @return integer
     */
    public function getStatusAttribute()
    {
        $now = date('Y-m-d');
        if(strtotime($now) < strtotime($this->tanggal_akhir)) {
            return 'Aktif';
        }

        return "Kadaluarsa";
    }



    public function paket_pendaftaran_membership()
    {
        return $this->belongsTo('App\PaketPendaftaranMembership');
    }

    public function pendaftaran_membership()
    {
        return $this->belongsTo('App\PendaftaranMembership');
    }
}
