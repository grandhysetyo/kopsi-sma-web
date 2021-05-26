<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeleksiProposal extends Model
{
    use HasFactory;
    protected $table='seleksi_proposals';
    protected $guarded = [];

    public function proposal()
    {
        return $this->belongsTo(\App\Models\Proposal::class, 'proposal_id','id');
    }

    public function juri()
    {
        return $this->belongsTo(\App\Models\Juri::class, 'juri_id','id');
    }
}
