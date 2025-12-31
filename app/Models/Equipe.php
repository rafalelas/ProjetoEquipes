<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model{
    protected $table='equipes';

    protected $fillable=['nome', 'criado_por', 'imagem','criado_por','criado_em'];
    
    public $timestamps = false;
    const CREATED_AT = 'criado_em';
    const UPDATED_AT = null;


    public function usuarios(){
        return $this->belongsToMany(Usuario::class, 'usuarios_equipes', 'equipe_id', 'usuario_id');
    }

    public function trabalhos(){
        return $this->hasMany(Trabalho::class);
    }

}
