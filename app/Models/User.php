<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ketua()
    {
        return $this->hasOne(\App\Models\Ketua::class, 'user_id','id');
    }

    public function anggota()
    {
        return $this->hasOne(\App\Models\Anggota::class, 'user_id','id');
    }

    public function juri()
    {
        return $this->hasOne(\App\Models\Juri::class, 'user_id','id');
    }

    public function twibbon()
    {
        return $this->hasOne(\App\Models\Twibbonice::class, 'user_id','id');
    }
}
