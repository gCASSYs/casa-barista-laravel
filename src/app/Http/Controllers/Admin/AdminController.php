<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


class AdminController extends Controller{


    // Metodo DASH - Carregar a INDEX (DASH)
    public function dashboard(){
          
       return view('admin.dashboard.dashboard');

    }
}    