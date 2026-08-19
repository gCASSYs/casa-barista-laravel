<?php

use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\SobreController;
use App\Http\Controllers\Site\CardapioController;
use App\Http\Controllers\Site\EventosController;
use App\Http\Controllers\Site\ContatoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

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