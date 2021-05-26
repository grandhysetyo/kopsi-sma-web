<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $table='anggotas';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id','id');
    }

    public function tim()
    {
        return $this->belongsTo(\App\Models\Tim::class, 'tim_id','id');
    }

    public function kelurahan()
    {
        return $this->belongsTo(\App\Models\Village::class, 'kelurahan_id','id');
    }

    public function ayahibu_anggota()
    {
        return $this->hasOne(\App\Models\OrangTuaAnggota::class, 'anggota_id','id');
    }

    public function prestasi()
    {
        return $this->hasMany(\App\Models\PrestasiAnggota::class, 'anggota_id','id');
    }
}
