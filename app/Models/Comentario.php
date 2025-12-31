<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'comentarios';

    public $timestamps = false;

    protected $fillable = [
        'versao_id',
        'usuario_id',
        'comentario',
        'criado_em'
    ];

    public function versao()
    {
        return $this->belongsTo(Versao::class, 'versao_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
