<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendaftaranMembership extends Model
{
    protected $table = 'pendaftaran_memberships';

    protected $guarded = [];

    /**
     * Get the paket for the pendaftaran membership.
     */
    public function packages()
    {
        return $this->belongsTo(PaketPendaftaranMembership::class, 'id_paket');
    }

    /**
     * Get the admin for the pendaftaran membership.
     */
    public function admins()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }

    /**
     * Get the members for the pendaftaran membership.
     */
    public function members()
    {
        return $this->belongsTo(Member::class, 'id_member');
    }
}
