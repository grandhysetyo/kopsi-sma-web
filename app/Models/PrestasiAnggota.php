<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiAnggota extends Model
{
    use HasFactory;
    protected $table='prestasi_anggotas';
    protected $guarded = [];


    public function anggota()
    {
        return $this->belongsTo(\App\Models\Anggota::class, 'anggota_id','id');
    }
}
