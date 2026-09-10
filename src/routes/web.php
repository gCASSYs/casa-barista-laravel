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
use App\Http\Controllers\Admin\UsuariosController;


//ROTAS WEB

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/sobre', [SobreController::class, 'sobre'])->name('sobre');
Route::get('/cardapio', [CardapioController::class, 'cardapio'])->name('cardapio');
Route::get('/cardapio/categoria/{id_categoria}', [CardapioController::class, 'cardapio'])->name('cardapio.categoria');
Route::get('/eventos', [EventosController::class, 'eventos'])->name('eventos');
Route::get('/contato', [ContatoController::class, 'contato'])->name('contato');
//Basicamente ele está dizendo: quando clicar vai ir para HomeController que tem uma classe, pois pode ter varios e um nome para facilitar

//PARTE DO DASHBOARD


Route::prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    //PARTE DO DASHBOARD DO BANNER
    Route::get('/banner', [BannerController::class, 'index'])->name('admin.banner.index');
   
    //CRUD DO BANNER:
    //CADASTRAR BANNER
    Route::post('/banner', [BannerController::class, 'store'])->name('admin.banner.store');
    //ABRIR O FORM DE EDITAR BANNER
    Route::get('/banner/{id}/editar', [BannerController::class, 'edit'])->name('admin.banner.edit');
    //ATUALIZAR BANNER
    Route::put('/banner/{id}', [BannerController::class, 'update'])->name('admin.banner.update');
    //ATIVAR OU DESATIVAR BANNER
    Route::patch('/banner/{id}/status', [BannerController::class, 'status'])->name('admin.banner.status');

    //PARTE DO DASHBOARD DA GALERIA
    Route::get('/galeria', [GaleriaController::class, 'index'])->name('admin.galeria.index');

    //CRUD DA GALERIA:
    //CADASTRAR GALERIA
    Route::post('/galeria', [GaleriaController::class, 'store'])->name('admin.galeria.store');
    //ABRIR O FORM DE EDITAR GALERIA
    Route::get('/galeria/{id}/editar', [GaleriaController::class, 'edit'])->name('admin.galeria.edit');
    //ATUALIZAR GALERIA
    Route::put('/galeria/{id}', [GaleriaController::class, 'update'])->name('admin.galeria.update');
    //ATIVAR OU DESATIVAR GALERIA
    Route::patch('/galeria/{id}/status', [GaleriaController::class, 'status'])->name('admin.galeria.status');


    //PARTE DO DASHBOARD DOS DEPOIMENTOS
    Route::get('/depoimento', [DepoimentoController::class, 'index'])->name('admin.depoimento.index');

    //CRUD DOS DEPOIMENTOS:
    //CADASTRAR DEPOIMENTO
    Route::post('/depoimento', [DepoimentoController::class, 'store'])->name('admin.depoimento.store');
    //ABRIR O FORM DE EDITAR DEPOIMENTO
    Route::get('/depoimento/{id}/editar', [DepoimentoController::class, 'edit'])->name('admin.depoimento.edit');
    //ATUALIZAR DEPOIMENTO
    Route::put('/depoimento/{id}', [DepoimentoController::class, 'update'])->name('admin.depoimento.update');
    //ATIVAR OU DESATIVAR DEPOIMENTO
    Route::patch('/depoimento/{id}/status', [DepoimentoController::class, 'status'])->name('admin.depoimento.status');

    //PARTE DO DASHBOARD DOS CLIENTES
    Route::get('/clientes', [ClientesController::class, 'index'])->name('admin.clientes.index');

    //CRUD DOS CLIENTES:
    //CADASTRAR CLIENTE
    Route::post('/clientes', [ClientesController::class, 'store'])->name('admin.clientes.store');
    //ABRIR O FORM DE EDITAR CLIENTE
    Route::get('/clientes/{id}/editar', [ClientesController::class, 'edit'])->name('admin.clientes.edit');
    //ATUALIZAR CLIENTE
    Route::put('/clientes/{id}', [ClientesController::class, 'update'])->name('admin.clientes.update');
    //ATIVAR OU DESATIVAR CLIENTE
    Route::patch('/clientes/{id}/status', [ClientesController::class, 'status'])->name('admin.clientes.status');

    //PARTE DO DASHBOARD DAS VENDAS
    Route::get('/venda', [VendaController::class, 'index'])->name('admin.venda.index');

    //CRUD DAS VENDAS:
    //CADASTRAR VENDA
    Route::post('/venda', [VendaController::class, 'store'])->name('admin.venda.store');
    //ABRIR O FORM DE EDITAR VENDA  
    Route::get('/venda/{id}/editar', [VendaController::class, 'edit'])->name('admin.venda.edit');
    //ATUALIZAR VENDA
    Route::put('/venda/{id}', [VendaController::class, 'update'])->name('admin.venda.update');
    //ATIVAR OU DESATIVAR VENDA
    Route::patch('/venda/{id}/status', [VendaController::class, 'status'])->name('admin.venda.status');

    //PARTE DO DASHBOARD DOS PRODUTOS
    Route::get('/produto', [ProdutoController::class, 'index'])->name('admin.produto.index');

    //CRUD DOS PRODUTOS:
    //CADASTRAR PRODUTO
    Route::post('/produto', [ProdutoController::class, 'store'])->name('admin.produto.store');
    //ABRIR O FORM DE EDITAR PRODUTO 
    Route::get('/produto/{id}/editar', [ProdutoController::class, 'edit'])->name('admin.produto.edit');
    //ATUALIZAR PRODUTO
    Route::put('/produto/{id}', [ProdutoController::class, 'update'])->name('admin.produto.update');
    //ATIVAR OU DESATIVAR PRODUTO
    Route::patch('/produto/{id}/status', [ProdutoController::class, 'status'])->name('admin.produto.status');

    //PARTE DO DASHBOARD DA LINHA DO TEMPO
    Route::get('/linhatempo', [LinhaTempoController::class, 'index'])->name('admin.linhatempo.index');

    //CRUD DA LINHA DO TEMPO:
    //CADASTRAR LINHA DO TEMPO
    Route::post('/linhatempo', [LinhaTempoController::class, 'store'])->name('admin.linhatempo.store');
    //ABRIR O FORM DE EDITAR LINHA DO TEMPO
    Route::get('/linhatempo/{id}/editar', [LinhaTempoController::class, 'edit'])->name('admin.linhatempo.edit');
    //ATUALIZAR LINHA DO TEMPO
    Route::put('/linhatempo/{id}', [LinhaTempoController::class, 'update'])->name('admin.linhatempo.update');
    //ATIVAR OU DESATIVAR LINHA DO TEMPO
    Route::patch('/linhatempo/{id}/status', [LinhaTempoController::class, 'status'])->name('admin.linhatempo.status');

    //PARTE DO DASHBOARD DA CATEGORIA
    Route::get('/categoria', [CategoriaController::class, 'index'])->name('admin.categoria.index');

    //CRUD DA CATEGORIA:
    //CADASTRAR CATEGORIA
    Route::post('/categoria', [CategoriaController::class, 'store'])->name('admin.categoria.store');
    //ABRIR O FORM DE EDITAR CATEGORIA
    Route::get('/categoria/{id}/editar', [CategoriaController::class, 'edit'])->name('admin.categoria.edit');
    //ATUALIZAR CATEGORIA
    Route::put('/categoria/{id}', [CategoriaController::class, 'update'])->name('admin.categoria.update');
    //ATIVAR OU DESATIVAR CATEGORIA
    Route::patch('/categoria/{id}/status', [CategoriaController::class, 'status'])->name('admin.categoria.status');

    //PARTE DO DASHBOARD DA NEWSLATTER
    Route::get('/news', [NewsController::class, 'index'])->name('admin.news.index');

    //CRUD DA NEWSLATTER:
    //CADASTRAR NEWSLATTER
    Route::post('/news', [NewsController::class, 'store'])->name('admin.news.store');
    //ABRIR O FORM DE EDITAR NEWSLATTER
    Route::get('/news/{id}/editar', [NewsController::class, 'edit'])->name('admin.news.edit');
    //ATUALIZAR NEWSLATTER
    Route::put('/news/{id}', [NewsController::class, 'update'])->name('admin.news.update');
    //ATIVAR OU DESATIVAR NEWSLATTER
    Route::patch('/news/{id}/status', [NewsController::class, 'status'])->name('admin.news.status');

    //PARTE DO DASHBOARD DOS USUÁRIOS
    Route::get('/usuarios', [UsuariosController::class, 'index'])->name('admin.usuarios.index');

    //CRUD DOS USUÁRIOS:
    //CADASTRAR USUÁRIO
    Route::post('/usuarios', [UsuariosController::class, 'store'])->name('admin.usuarios.store');
    //ABRIR O FORM DE EDITAR USUÁRIO
    Route::get('/usuarios/{id}/editar', [UsuariosController::class, 'edit'])->name('admin.usuarios.edit');
    //ATUALIZAR USUÁRIO
    Route::put('/usuarios/{id}', [UsuariosController::class, 'update'])->name('admin.usuarios.update');
    //ATIVAR OU DESATIVAR USUÁRIO
    Route::patch('/usuarios/{id}/status', [UsuariosController::class, 'status'])->name('admin.usuarios.status');

});    

//Metodo Get é buscar dados
//Metodo Post é criar dados
//Metodo Put é atualizar dados (ex: atualizar todos os dados de um banner, por exemplo)
//Metodo Delete é excluir dados
//Metodo Patch é atualizar parcialmente os dados (ex: atualizar apenas o status de um banner, por exemplo)