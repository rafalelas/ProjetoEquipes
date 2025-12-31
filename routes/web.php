<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\CheckLog;
use App\Http\Middleware\CheckNotLog;

// Rotas públicas - AuthController
Route::middleware([CheckNotLog::class])->group(function(){
    Route::get('/login', [MainController::class, 'login'])->name('login');
    Route::get('/cadastro', [MainController::class, 'cadastro'])->name('cadastro');
    
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit'])->name('loginSubmit');
    Route::post('/cadastroSubmit', [AuthController::class, 'cadastroSubmit'])->name('cadastroSubmit');

});



// Rotas protegidas - MainController
Route::middleware([CheckLog::class])->group(function () {
    Route::get('/logout', [MainController::class, 'logout'])->name('logout');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    Route::get('/criar_equipe', [MainController::class, 'criarEquipe'])->name('criarEquipe');
    Route::get('/criar_trabalho/{equipe}', [MainController::class, 'criarTrabalho'])->name('criarTrabalho');
    Route::get('/editar_equipe/{equipe}',[MainController::class, 'editarEquipe'])->name('editarEquipe');
    
    Route::post('/criar_equipe_Submit', [AuthController::class, 'criarEquipeSubmit'])->name('criarEquipeSubmit');
    Route::post('/criar_trabalho_Submit', [AuthController::class, 'criarTrabalhoSubmit'])->name('criarTrabalhoSubmit');
    Route::post('/editar_equipe_Submit/{equipe}',[AuthController::class,'editarEquipeSubmit'])->name('editarEquipeSubmit');
    
    Route::get('/trabalhos/{equipe}',[AuthController::class,'mostraTrabalhoEquipe'])->name('trabalhos');
    Route::get('/editar_trabalho/{trabalho}', [MainController::class, 'editarTrabalho'])->name('editarTrabalho');
    
    Route::post('/editar_trabalho_Submit/{trabalho}', [MainController::class, 'editarTrabalhoSubmit'])->name('editarTrabalhoSubmit');

    Route::get('/info_trabalho/{id}', [MainController::class, 'infoTrabalho'])->name('infoTrabalho');
    Route::get('/info_equipe/{equipe}', [MainController::class, 'infoEquipe'])->name('infoEquipe');
    Route::post('/versao/{versao}/comentarios', [MainController::class, 'salvarComentarioVersao'])->name('comentarios.salvar');
});