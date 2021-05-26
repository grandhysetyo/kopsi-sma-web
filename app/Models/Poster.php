<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    use HasFactory;
    protected $table='posters';
    protected $guarded = [];

    public function tim()
    {
        return $this->belongsTo(\App\Models\Tim::class, 'tim_id','id');
    }

    public function juri_nilai_poster()
    {
        return $this->hasMany(\App\Models\JuriNilaiPoster::class, 'poster_id','id');
    }
}
