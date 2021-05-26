<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Naskah extends Model
{
    use HasFactory;
    protected $table='naskahs';
    protected $guarded = [];

    public function tim()
    {
        return $this->belongsTo(\App\Models\Tim::class, 'tim_id','id');
    }

    public function seleksi_naskah()
    {
        return $this->hasMany(\App\Models\SeleksiNaskah::class, 'naskah_id','id');
    }

    public function juri()
    {
        return $this->belongsToMany('App\Models\Juri');
    }
}
