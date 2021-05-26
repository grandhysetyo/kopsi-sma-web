<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AspekNilaiPoster extends Model
{
    use HasFactory;
    protected $table='aspek_nilai_posters';
    protected $guarded = [];

    public function bidang()
    {
        return $this->belongsTo(\App\Models\Bidang::class, 'bidang_id','id');
    }

    public function nilai_poster()
    {
        return $this->hasMany(\App\Models\NilaiPoster::class, 'apsek_id','id');
    }
}
