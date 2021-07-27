<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**Relacionar con el modelo Role */
    public function role(){
        return $this->belongsTo(Role::class);
    }

    /**Relacionar con el modelo Horario */
    public function horarios(){
        return $this->hasMany(Horario::class);
    }

    /**Relacionar con el modelo Support */
    public function supports(){
        return $this->hasMany(Support::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
