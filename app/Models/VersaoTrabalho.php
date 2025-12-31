<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VersaoTrabalho extends Model
{
    protected $table = 'versoes_trabalho';

    public $timestamps = false;
    
    const CREATED_AT = 'criado_em';
    const UPDATED_AT = null;

    protected $fillable = [
        'trabalho_id',
        'numero_versao',
        'arquivos',
        'resumo_alteracoes',
        'criado_em'
    ];

    public function trabalho()
    {
        return $this->belongsTo(Trabalho::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'versao_id');
    }
}
