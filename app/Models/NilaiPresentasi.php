<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPresentasi extends Model
{
    use HasFactory;
    protected $table='nilai_presentasis';
    protected $guarded = [];

    public function juri_nilai_presentasi()
    {
        return $this->belongsTo(\App\Models\JuriNilaiPresentasi::class, 'seleksi_id','id');
    }

    public function aspek_presentasi()
    {
        return $this->belongsTo(\App\Models\AspekNilaiPresentasi::class, 'aspek_id','id');
    }
}
