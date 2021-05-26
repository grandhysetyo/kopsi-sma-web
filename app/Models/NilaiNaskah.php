<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiNaskah extends Model
{
    use HasFactory;
    protected $table='nilai_naskahs';
    protected $guarded = [];

    public function seleksi_naskah()
    {
        return $this->belongsTo(\App\Models\SeleksiNaskah::class, 'seleksi_id','id');
    }

    public function aspek()
    {
        return $this->belongsTo(\App\Models\AspekNilaiNaskah::class, 'aspek_id','id');
    }
}
