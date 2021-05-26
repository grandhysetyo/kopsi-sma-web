<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JuriNilaiPresentasi extends Model
{
    use HasFactory;
    protected $table='juri_nilai_presentasis';
    protected $guarded = [];

    public function presentasi()
    {
        return $this->belongsTo(\App\Models\Presentasi::class, 'presentasi_id','id');
    }

    public function juri()
    {
        return $this->belongsTo(\App\Models\Juri::class, 'juri_id','id');
    }

    public function nilai_presentasi()
    {
        return $this->hasMany(\App\Models\NilaiPresentasi::class, 'seleksi_id','id');
    }
}
