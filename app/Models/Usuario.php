<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Usuario extends Authenticatable{
    protected $table = 'usuarios';

    public $timestamps = false;
    
    const CREATED_AT = 'criado_em';
    const UPDATED_AT = null; 

    protected $fillable = ['nome', 'email', 'senha'];

    protected $hidden = ['senha'];

    public function getAuthPassword(){
        return $this->senha;
    }


    public function equipes(){
        return $this->belongsToMany(Equipe::class, 'usuarios_equipes', 'usuario_id', 'equipe_id');
    }

}

