<?php

namespace App\Providers;

use App\Models\Categoria;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
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
    public function boot(): void
    {
        //Carregar o submenu de categorias no menu principal do site
        View::composer('partials.site.topo', function ($view) {
            
            //Query para buscar as categorias ativas no banco de dados e ordenar pelo nome da categoria
            $categoriaMenu = Categoria::query()
            ->where('status_categoria', 'ATIVO')
            ->orderBy('nome_categoria')
            ->get();

            //***Passar a variável $categoriaMenu para a view 'partials.topo'*/
            $view->with('categoriaMenu', $categoriaMenu);
        
        });
    }
}

