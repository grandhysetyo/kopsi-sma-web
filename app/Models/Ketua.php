<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ketua extends Model
{
    use HasFactory;
    protected $table='ketuas';
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

    public function ayahibu_ketua()
    {
        return $this->hasOne(\App\Models\OrangTuaKetua::class, 'ketua_id','id');
    }

    public function prestasi()
    {
        return $this->hasMany(\App\Models\PrestasiKetua::class, 'ketua_id','id');
    }
}
