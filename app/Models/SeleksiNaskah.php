<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeleksiNaskah extends Model
{
    use HasFactory;
    protected $table='seleksi_naskahs';
    protected $guarded = [];

    public function naskah()
    {
        return $this->belongsTo(\App\Models\Naskah::class, 'naskah_id','id');
    }

    public function juri()
    {
        return $this->belongsTo(\App\Models\Juri::class, 'juri_id','id');
    }

    public function nilai_naskah()
    {
        return $this->hasMany(\App\Models\NilaiNaskah::class, 'seleksi_id','id');
    }
}
