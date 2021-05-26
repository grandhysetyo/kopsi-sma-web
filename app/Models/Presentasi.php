<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentasi extends Model
{
    use HasFactory;
    protected $table='presentasis';
    protected $guarded = [];

    public function tim()
    {
        return $this->belongsTo(\App\Models\Tim::class, 'tim_id','id');
    }

    public function juri_nilai_presentasi()
    {
        return $this->hasMany(\App\Models\JuriNilaiPresentasi::class, 'presentasi_id','id');
    }
}
