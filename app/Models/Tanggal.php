<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggal extends Model
{
    use HasFactory;
    protected $table='tanggals';
    protected $guarded = [];

    public function linimasa()
    {
        return $this->belongsTo(\App\Models\Linimasa::class, 'linimasa_id','id');
    }
}
