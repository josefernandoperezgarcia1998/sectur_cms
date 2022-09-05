<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use App\Models\Menu;
use App\Models\Pagina;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $usuarioContador = User::count();
        $menuContador = Menu::count();
        $paginaContador = Pagina::count();
    
        return view('dashboard.tablero', compact('usuarioContador', 'menuContador', 'paginaContador'));
    }

    // Función que pasa las variables del footer a la pagina de welcome
    public function welcome()
    {
        $contenidoFooterContacto = Footer::where('tipo', 1)->where('estado','Si')->get();
        $contenidoFooterRecurso = Footer::where('tipo', 2)->where('estado','Si')->get();
        $contenidoFooterRedes = Footer::where('tipo', 3)->where('estado','Si')->get();
        // dd($contenidoContacto);
        return view('welcome', compact('contenidoFooterContacto', 'contenidoFooterRecurso', 'contenidoFooterRedes'));
    }

}
