<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;

class BannerController extends Controller
{   
    //Lista todos os banners cadastrados
    public function index()
    {
        $listaBanner = Banner::orderBy('id_banner')->get();

        
        return view('admin.banner.index', compact('listaBanner'));
    }
}