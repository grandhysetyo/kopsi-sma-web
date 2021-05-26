<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JuriNilaiPoster extends Model
{
    use HasFactory;
    protected $table='juri_nilai_posters';
    protected $guarded = [];

    public function poster()
    {
        return $this->belongsTo(\App\Models\Poster::class, 'poster_id','id');
    }

    public function juri()
    {
        return $this->belongsTo(\App\Models\Juri::class, 'juri_id','id');
    }

    public function nilai_poster()
    {
        return $this->hasMany(\App\Models\NilaiPoster::class, 'seleksi_id','id');
    }
}
