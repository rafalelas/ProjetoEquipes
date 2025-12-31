<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;
use App\Models\Equipe;


class DashboardController extends Controller
{
    public function home(Request $request){
        $userId = Auth::id();
        if (!$userId) return redirect()->route('login');

        $usuario = Usuario::find($userId);
        if (!$usuario) return redirect()->route('login');

        $equipes = $usuario->equipes;

        $equipeIdSelecionada = $request->query('equipe_id');

        $equipeSelecionada = $equipes->firstWhere('id', $equipeIdSelecionada) ?? $equipes->first();

        $trabalhos = collect();

        if ($equipeSelecionada) {
            $trabalhos = DB::table('trabalhos')
                ->where('equipe_id', $equipeSelecionada->id)
                ->orderBy('criado_em', 'desc')
                ->get();
        }

        return view('dashboard', compact('trabalhos', 'equipes', 'equipeSelecionada'));
    }
}
