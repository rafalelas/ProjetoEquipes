<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            // Pega o path da URL (ex.: /home/cadastro)
            $path = Request::path();

            // Se for a página inicial, define um título padrão
            if ($path === '/') {
                $pageTitle = 'Login';
            } else {
                // Transforma o path em título (ex.: home/cadastro → Home Cadastro)
                $pageTitle = ucwords(str_replace(['-', '/'], ' ', $path));
            }

            // Compartilha com todas as views
            $view->with('pageTitle', $pageTitle);
        });
    }
}
