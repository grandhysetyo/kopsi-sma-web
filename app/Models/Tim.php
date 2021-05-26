<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tim extends Model
{
    use HasFactory;
    protected $table='tims';
    protected $guarded = [];

    public function provinsi()
    {
        return $this->belongsTo(\App\Models\Province::class, 'province_id','id');
    }

    public function sekolah()
    {
        return $this->belongsTo(\App\Models\Sekolah::class, 'sekolah_id','id');
    }

    public function bidang()
    {
        return $this->belongsTo(\App\Models\SubBidang::class, 'bidang_id','id');
    }

    public function ketua()
    {
        return $this->hasOne(\App\Models\Ketua::class, 'tim_id','id');
    }

    public function pembimbing()
    {
        return $this->hasOne(\App\Models\Pembimbing::class, 'tim_id','id');
    }

    public function anggota()
    {
        return $this->hasMany(\App\Models\Anggota::class, 'tim_id','id');
    }

    public function unggahan()
    {
        return $this->hasMany(\App\Models\UnggahanBerkas::class, 'tim_id','id');
    }

    public function unggahan_tim()
    {
        return $this->hasMany(\App\Models\UnggahanTim::class, 'tim_id','id');
    }

    public function proposal()
    {
        return $this->hasOne(\App\Models\Proposal::class, 'tim_id','id');
    }

    public function naskah()
    {
        return $this->hasOne(\App\Models\Naskah::class, 'tim_id','id');
    }

    public function poster()
    {
        return $this->hasOne(\App\Models\Poster::class, 'tim_id','id');
    }

    public function presentasi()
    {
        return $this->hasOne(\App\Models\Presentasi::class, 'tim_id','id');
    }
}
