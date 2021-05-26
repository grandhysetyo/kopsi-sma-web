<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangTuaKetua extends Model
{
    use HasFactory;
    protected $table='orang_tua_ketuas';
    protected $guarded = [];

    public function ketua()
    {
        return $this->belongsTo(\App\Models\Ketua::class, 'ketua_id','id');
    }

    public function kelurahan()
    {
        return $this->belongsTo(\App\Models\Village::class, 'kelurahan_id','id');
    }
}
