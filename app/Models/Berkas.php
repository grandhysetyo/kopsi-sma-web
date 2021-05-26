<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    use HasFactory;
    protected $table='berkas';
    protected $guarded = [];

    public function unggahan()
    {
        return $this->hasMany(\App\Models\UnggahanBerkas::class, 'berkas_id','id');
    }
}
