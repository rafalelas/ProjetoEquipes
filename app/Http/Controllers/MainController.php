<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use App\Models\Equipe;
use App\Models\Trabalho;
use App\Models\Comentario;


class MainController extends Controller
{
   public function login(){
        return view('login');
    }
    
    public function cadastro(){
        return view('cadastro');
    }

    public function home(){
        $usuario = auth()->user();

        // Puxa as equipes do usuário junto com os membros
        $equipes = $usuario->equipes()->with('usuarios')->get();

        return view('home', compact('equipes'));
    }

    
    public function criarEquipe(){
        $usuarios=Usuario::all();
        return view('criar_equipe', [
            'usuarios'=>$usuarios,
            'equipes'=>Auth::user()->equipes,
            'equipeSelecionada'=>null
        ]);
    }
    public function criarTrabalho($equipeId){
        $equipe=Equipe::findOrFail($equipeId);
        $usuario=auth()->user();
        $equipes=$usuario->equipes;
        
        return view('criar_trabalho',[
            'equipe'=>$equipe,
            'equipeSelecionada'=>$equipe,
            'equipes'=>$equipes
        ]);
    }

    public function infoEquipe($id) {
        $equipe = Equipe::with(['usuarios', 'trabalhos'])->findOrFail($id);
        return view('ver_equipe', compact('equipe'));
    }

    
    public function editarEquipe(Equipe $equipe){
        $usuario=auth()->user();
        $usuarios=Usuario::all();
        return view('editar_equipe',compact('equipe','usuario','usuarios'));
    }

    
    public function editarTrabalhoSubmit(Request $request, \App\Models\Trabalho $trabalho){
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'resumo_alteracoes' => 'required|string',
            'arquivo' => 'nullable|file|max:2048'
        ]);

        // Salva a versão anterior
        $ultimaVersao = $trabalho->versoes()->orderByDesc('numero_versao')->first();
        $novaVersaoNum = $ultimaVersao ? $ultimaVersao->numero_versao + 1 : 1;

        $arquivoPath = null;

        if ($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {
            $nomeArquivo = time() . '_' . $request->file('arquivo')->getClientOriginalName();
            $request->file('arquivo')->move(public_path('assets/arquivos'), $nomeArquivo);
            $arquivoPath = 'assets/arquivos/' . $nomeArquivo;
        }

        $trabalho->versoes()->create([
            'numero_versao' => $novaVersaoNum,
            'arquivo' => $arquivoPath,
            'resumo_alteracoes' => $request->resumo_alteracoes,
            'criado_em' => now(),
        ]);


        // Atualiza o trabalho atual
        $trabalho->titulo = $request->titulo;
        $trabalho->descricao = $request->descricao;
        $trabalho->save();

        return redirect()->route('home')->with('success', 'Trabalho editado e versão salva com sucesso!');
    }

    public function editarTrabalho(Trabalho $trabalho) {
        $usuario = auth()->user();
        $equipes = $usuario->equipes;

        return view('editar_trabalho', compact('trabalho', 'equipes'));
    }

    public function salvarComentarioVersao(Request $request, \App\Models\VersaoTrabalho $versao){
        $request->validate(['comentario' => 'required|string|max:1000']);

        // Só usuários da equipe podem comentar (validação simples)
        if (! $versao->trabalho->equipe->usuarios->contains(auth()->id())) {
            abort(403, 'Você não pode comentar nesta versão.');
        }

        $versao->comentarios()->create([
            'usuario_id' => auth()->id(),
            'comentario'=>$request->comentario,
            'criado_em'=>now()
        ]);

        return redirect()->route('infoTrabalho', ['id' => $versao->trabalho->id])->with('success', 'Comentário adicionado!');
    }

    public function infoTrabalho($id){
        $trabalho=Trabalho::with(['equipe.usuarios', 'versoes.comentarios.usuario'])->findOrFail($id);
        return view('ver_trabalho', compact('trabalho'));
    }

    
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    } 
}
