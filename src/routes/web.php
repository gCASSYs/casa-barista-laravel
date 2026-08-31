<?php

use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\SobreController;
use App\Http\Controllers\Site\CardapioController;
use App\Http\Controllers\Site\EventosController;
use App\Http\Controllers\Site\ContatoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\GaleriaController;
use App\Http\Controllers\Admin\DepoimentoController;
use App\Http\Controllers\Admin\ClientesController;
use App\Http\Controllers\Admin\VendaController;
use App\Http\Controllers\Admin\ProdutoController;
use App\Http\Controllers\Admin\LinhaTempoController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\CategoriaController;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/sobre', [SobreController::class, 'sobre'])->name('sobre');

Route::get('/cardapio', [CardapioController::class, 'cardapio'])->name('cardapio');

//essa route é para quando clicar no menu cardápio, ele vai para o cardapioController e vai chamar o método cardapio que está dentro do cardapioController
Route::get('/cardapio/categoria/{id_categoria}', [CardapioController::class, 'cardapio'])->name('cardapio.categoria');


Route::get('/eventos', [EventosController::class, 'eventos'])->name('eventos');
Route::get('/contato', [ContatoController::class, 'contato'])->name('contato');
//Basicamente ele está dizendo: quando clicar vai ir para HomeController que tem uma classe, pois pode ter varios e um nome para facilitar


//PARTE DO DASHBOARD
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

//PARTE DO DASHBOARD DO BANNER
Route::get('/admin/banner', [BannerController::class, 'index'])->name('admin.banner.index');

//PARTE DO DASHBOARD DA GALERIA
Route::get('/admin/galeria', [GaleriaController::class, 'index'])->name('admin.galeria.index');

//PARTE DO DASHBOARD DOS DEPOIMENTOS
Route::get('/admin/depoimento', [DepoimentoController::class, 'index'])->name('admin.depoimento.index');

//PARTE DO DASHBOARD DOS CLIENTES
Route::get('/admin/clientes', [ClientesController::class, 'index'])->name('admin.clientes.index');

//PARTE DO DASHBOARD DAS VENDAS
Route::get('/admin/venda', [VendaController::class, 'index'])->name('admin.venda.index');

//PARTE DO DASHBOARD DOS PRODUTOS
Route::get('/admin/produto', [ProdutoController::class, 'index'])->name('admin.produto.index');

//PARTE DO DASHBOARD DA LINHA DO TEMPO
Route::get('/admin/linhatempo', [LinhaTempoController::class, 'index'])->name('admin.linhatempo.index');

//PARTE DO DASHBOARD DA CATEGORIA
Route::get('/admin/categoria', [CategoriaController::class, 'index'])->name('admin.categoria.index');

//PARTE DO DASHBOARD DA NEWSLATTER
Route::get('/admin/news', [NewsController::class, 'index'])->name('admin.news.index');