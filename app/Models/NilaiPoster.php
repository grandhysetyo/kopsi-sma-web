<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPoster extends Model
{
    use HasFactory;
    protected $table='nilai_posters';
    protected $guarded = [];

    public function juri_nilai_poster()
    {
        return $this->belongsTo(\App\Models\JuriNilaiPoster::class, 'seleksi_id','id');
    }

    public function aspek()
    {
        return $this->belongsTo(\App\Models\AspekNilaiPoster::class, 'aspek_id','id');
    }
}
