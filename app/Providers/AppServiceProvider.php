<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void{
        View::composer('*', function ($view) {
            $usuario = Auth::user();
            $equipes = $usuario ? $usuario->equipes()->get() : collect();

            // pega a equipe selecionada da rota, se existir
            $equipeSelecionada = null;
            if (request()->route('equipe')) {
                $equipeId = request()->route('equipe');
                $equipeSelecionada = $equipes->firstWhere('id', is_object($equipeId) ? $equipeId->id : $equipeId);
            }

            $view->with([
                'equipes' => $equipes,
                'equipeSelecionada' => $equipeSelecionada
            ]);
        });
    }
}
