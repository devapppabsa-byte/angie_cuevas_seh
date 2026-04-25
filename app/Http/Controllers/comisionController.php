<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class comisionController extends Controller
{
    public function index(){
        return view('comision.perfil');
    }
}
