<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasPengumuman extends Model
{
    use HasFactory;
    protected $table='berkas_pengumumen';
    protected $guarded = ['id'];

    public function info()
    {
        return $this->belongsTo(\App\Models\Info::class, 'info_id','id');
    }
}
