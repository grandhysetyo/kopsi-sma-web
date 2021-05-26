<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juri extends Model
{
    use HasFactory;
    protected $table='juris';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id','id');
    }

    public function seleksi_proposal()
    {
        return $this->hasMany(\App\Models\SeleksiProposal::class, 'juri_id','id');
    }

    public function bidang()
    {
        return $this->belongsToMany('App\Models\Bidang');
    }

    public function seleksi_naskah()
    {
        return $this->hasMany(\App\Models\SeleksiNaskah::class, 'juri_id','id');
    }

    public function juri_nilai_poster()
    {
        return $this->hasMany(\App\Models\JuriNilaiPoster::class, 'juri_id','id');
    }

    public function juri_nilai_presentasi()
    {
        return $this->hasMany(\App\Models\JuriNilaiPresentasi::class, 'juri_id','id');
    }
}
