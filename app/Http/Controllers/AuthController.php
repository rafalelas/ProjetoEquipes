<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Equipe;
use App\Models\Trabalho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller{

    public function cadastroSubmit(Request $request){
        $dados=$request->validate([
            'nome'=>'required|string',
            'email'=>'required|email',
            'password'=>'required|min:6|max:16|confirmed',
        ]);

        DB::table('usuarios')->insertGetId([
            'nome'=>$dados['nome'],
            'email'=>$dados['email'],
            'senha'=>bcrypt($dados['password']),
            'criado_em'=>now()
        ]);

        return redirect()->route('login')->with('success', 'Cadastro realizado com sucesso! Faça login para continuar.');

    }

    public function loginSubmit(Request $request){
        $dados=$request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $usuario=Usuario::where('email', $dados['email'])->first();

        
       
        if ($usuario && password_verify($dados['password'], $usuario->senha)) {
            Auth::login($usuario);
            return redirect()->route('home');
        }
        

        return redirect()->back()->withInput()->with('loginError', 'Email ou senha incorretos');
    }

    public function criarEquipeSubmit(Request $request){
        $dados=$request->validate([
            'nome'=>'required|string|max:255',
            'imagem'=>'nullable|image|max:2048',
            'membros'=>'nullable|array',
            'membros.*'=>'exists:usuarios,id'
        ]);

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $nomeArquivo=time() . '_' . $request->file('imagem')->getClientOriginalName();

            $request->file('imagem')->move(public_path('assets/images'), $nomeArquivo);
        
            $dados['imagem'] = 'assets/images/'. $nomeArquivo;
        }

        $equipe = Equipe::create([
            'nome' => $dados['nome'],
            'imagem' => $dados['imagem'] ?? null,
            'criado_por'=>Auth::id()
        ]);

        $membros = $dados['membros'] ?? [];

        if (!in_array(Auth::id(), $membros)) {
            $membros[] = Auth::id();
        }

        $equipe->usuarios()->sync($membros);

        return redirect()->route('home')->with('sucesso', 'Equipe criada com sucesso!');
        dd('redirecionou');
    }


    public function criarTrabalhoSubmit(Request $request){
        $request->validate([
            'titulo'=>'required|string|max:255',
            'equipe_id'=>'required|exists:equipes,id'
        ]);

        Trabalho::create([
            'titulo'=>$request->titulo,
            'equipe_id'=>$request->equipe_id
        ]);

        return redirect()->route('trabalhos', ['equipe'=>$request->equipe_id])->with('success','Trabalho criado com sucesso!');
    }

    public function editarEquipeSubmit(Request $request, Equipe $equipe){
        $request->validate([
            'nome'=>'required|string|max:255',
            'imagem'=>'nullable|image|max:2048',
            'membros'=>'nullable|array',
            'membros.*'=>'exists:usuarios,id'
        ]);

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $nomeArquivo=time() . '_' . $request->file('imagem')->getClientOriginalName();

            $request->file('imagem')->move(public_path('assets/images'), $nomeArquivo);
        
           $equipe->imagem='assets/images/' . $nomeArquivo;
        }

        $equipe->nome = $request->nome;

        $equipe->save();

        $equipe->usuarios()->sync($request->membros ?? []);

        return redirect()->route('home')->with('success', 'Equipe atualizada com sucesso!');
    }

    public function mostraTrabalhoEquipe(Equipe $equipe){
        $usuario=auth()->user();
        $equipes=$usuario->equipes;

        $equipe->load('trabalhos');

        return view('trabalhos', [
            'equipes' => $equipes,
            'equipeSelecionada'=>$equipe,
            'equipe'=>$equipe,
            'trabalhos' => $equipe->trabalhos
        ]);
    }

    public function mostrarTrabalho(Trabalho $trabalho){
        $trabalho->load('equipe.usuarios','versoes.comentarios.usuario');

        return view('ver_trabalho',compact('trabalho'));
    }


}
