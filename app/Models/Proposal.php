<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;
    protected $table='proposals';
    protected $guarded = [];

    public function tim()
    {
        return $this->belongsTo(\App\Models\Tim::class, 'tim_id','id');
    }

    public function seleksi_proposal()
    {
        return $this->hasOne(\App\Models\SeleksiProposal::class, 'proposal_id','id');
    }

    public function juri()
    {
        return $this->belongsToMany('App\Models\Juri');
    }
}
