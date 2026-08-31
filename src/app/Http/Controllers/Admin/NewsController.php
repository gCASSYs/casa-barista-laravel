<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;

class NewsController extends Controller
{   
    //Lista de todas as news cadastrados
    public function index()
    {
        $listaNews = News::orderBy('id_news')->get();

        
        return view('admin.news.index', compact('listaNews'));
    }
}