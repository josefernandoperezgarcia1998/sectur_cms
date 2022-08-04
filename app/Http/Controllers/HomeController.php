<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $usuarioContador = User::count();
        $menuContador = Menu::count();
    
        return view('dashboard.tablero', compact('usuarioContador', 'menuContador'));
    }
}
