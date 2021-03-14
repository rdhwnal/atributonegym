<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ColumnFilterer;

class PaketPendaftaranMembership extends Model
{
    use ColumnFilterer;

    protected $table = 'paket_pendaftaran_memberships';

    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_paket',
        'durasi_paket',
        'deskripsi_paket',
        'harga_paket',
    ];

    public $timestamps = false;

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function pendaftaran_memberships()
    {
        return $this->hasMany(PendaftaranMembership::class);
    }
}
