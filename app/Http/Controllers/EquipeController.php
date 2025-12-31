<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Equipe;
use App\Models\Trabalho;

class EquipeController extends Controller
{
    public function minhasEquipes()
    {
        $usuario = Auth::user();
        $equipes = $usuario->equipes;

        return view('minhas_equipes', compact('equipes'));
    }

    public function detalhesEquipe($id)
    {
        $equipe = Equipe::findOrFail($id);
        if (!$equipe->usuarios->contains(Auth::id())) {
            abort(403, 'Você não tem permissão para acessar esta equipe.');
        }

        $trabalhos = $equipe->trabalhos;

        return view('detalhes_equipe', compact('equipe', 'trabalhos'));
    }
}

