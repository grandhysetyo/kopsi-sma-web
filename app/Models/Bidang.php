<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Bidang extends Model
{
    use HasFactory;

    protected $table='bidangs';
    protected $guarded = [];

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value, '-');
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sub_bidang()
    {
        return $this->hasMany(\App\Models\SubBidang::class, 'bidang_id','id');
    }

    public function link()
    {
        return $this->hasMany(\App\Models\LinkMeeting::class, 'bidang_id','id');
    }

    public function aspek()
    {
        return $this->hasMany(\App\Models\AspekNilaiNaskah::class, 'bidang_id','id');
    }

    public function aspek_poster()
    {
        return $this->hasMany(\App\Models\AspekNilaiPoster::class, 'bidang_id','id');
    }

    public function aspek_presentasi()
    {
        return $this->hasMany(\App\Models\AspekNilaiPresentasi::class, 'bidang_id','id');
    }

    public function juri()
    {
        return $this->belongsToMany('App\Models\Juri');
    }
}
