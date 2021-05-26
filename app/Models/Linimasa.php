<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linimasa extends Model
{
    use HasFactory;
    protected $table='linimasas';
    protected $guarded = [];

    public function tanggal()
    {
        return $this->hasMany(\App\Models\Tanggal::class, 'linimasa_id','id');
    }
}
