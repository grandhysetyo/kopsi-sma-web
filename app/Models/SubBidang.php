<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBidang extends Model
{
    use HasFactory;
    protected $table='sub_bidangs';
    protected $guarded = [];

    public function tim()
    {
        return $this->hasMany(\App\Models\Tim::class, 'bidang_id','id');
    }

    public function bidang()
    {
        return $this->belongsTo(\App\Models\Bidang::class, 'bidang_id','id');
    }
}
