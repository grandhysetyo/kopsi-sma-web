<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiKetua extends Model
{
    use HasFactory;
    protected $table='prestasi_ketuas';
    protected $guarded = [];


    public function ketua()
    {
        return $this->belongsTo(\App\Models\Ketua::class, 'ketua_id','id');
    }
}
