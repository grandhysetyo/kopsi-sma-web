<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AspekNilaiNaskah extends Model
{
    use HasFactory;
    protected $table='aspek_nilai_naskahs';
    protected $guarded = [];

    public function bidang()
    {
        return $this->belongsTo(\App\Models\Bidang::class, 'bidang_id','id');
    }

    public function nilai_naskah()
    {
        return $this->hasMany(\App\Models\NilaiNaskah::class, 'apsek_id','id');
    }
}
