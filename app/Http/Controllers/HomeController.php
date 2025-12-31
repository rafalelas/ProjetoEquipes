<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;


class HomeController extends Controller{
    public function index(Request $request){
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

        return view('home', compact('trabalhos', 'equipes', 'equipeSelecionada'));
    }

}
