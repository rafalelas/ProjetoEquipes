<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trabalho extends Model{
    protected $table='trabalhos';
    protected $fillable=['titulo','descricao','equipe_id','criado_em'];

    public $timestamps = false;

    const CREATED_AT = 'criado_em';
    const UPDATED_AT = null; 

    public function equipe(){
        return $this->belongsTo(Equipe::class);
    }

    public function versoes(){
        return $this->hasMany(VersaoTrabalho::class);
    }


}
