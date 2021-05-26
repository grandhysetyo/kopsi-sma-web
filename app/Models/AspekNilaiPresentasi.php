<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AspekNilaiPresentasi extends Model
{
    use HasFactory;
    protected $table='aspek_nilai_presentasis';
    protected $guarded = [];

    public function bidang()
    {
        return $this->belongsTo(\App\Models\Bidang::class, 'bidang_id','id');
    }

    public function nilai_presentasi()
    {
        return $this->hasMany(\App\Models\NilaiPresentasi::class, 'apsek_id','id');
    }
}
