<?php

use App\Http\Controllers\Site\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');

//Basicamente ele está dizendo: quando clicar vai ir para HomeController que tem uma classe, pois pode ter varios e um nome para facilitar