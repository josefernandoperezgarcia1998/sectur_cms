<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutenticarController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaginaController;
use App\Http\Controllers\FooterController;


// Route::get('/', function () {
//     return view('welcome');
// })->name('inicio');

Route::get('/', [HomeController::class,'welcome'])->name('inicio');

// Vista al dashboard ó tablero principal
Route::get('tablero', [HomeController::class, 'index'])->name('dashboard');

/* Rutas para iniciar sesión y cerrar sesión */
Route::get('iniciar-sesion', [AutenticarController::class, 'credenciales'])->name('login');
Route::post('validar', [AutenticarController::class, 'autenticar'])->name('validar');
Route::get('salir', [AutenticarController::class, 'salida'])->name('salir');

// Ruta tipo resource para usuarios
Route::resource('usuarios', UsuarioController::class)->names('usuarios');

// Ruta con ajax para obtener toda la data de usuarios con datatables
Route::get('usuarios-data', [UsuarioController::class, 'usersDatatables'])->name('usuarios-data');

// Ruta tipo resource para menu
Route::resource('menus', MenuController::class)->names('menus');

// Ruta con ajax para obtener toda la data del menu con datatables
Route::get('menus-data', [MenuController::class, 'menusDatatables'])->name('menus-data');

// Ruta tipo resource para footer
Route::resource('footers', FooterController::class)->names('footers');
Route::get('footer', [FooterController::class, 'inicio'])->name('footer.inicio');

// Ruta con ajax para obtener toda la data del footer con datatables
Route::get('footers-data', [FooterController::class, 'footersDataTables'])->name('footers-data');

// Ruta con AJAX para ver si un slug de menú está disponible ó no
Route::post('slug-check', [MenuController::class, 'check'])->name('menu.register-check');

// Ruta resource para las páginas
Route::resource('paginas', PaginaController::class)->names('paginas');

// Ruta con ajax para obtener toda la data del menu con datatables
Route::get('paginas-data', [PaginaController::class, 'paginasDatatables'])->name('paginas-data');

// Ruta get para visualziar las páginas
Route::get('{pagina}', [PaginaController::class, 'tipoPagina'])->name('pagina');

// Ruta para subir imagen
Route::post('image/upload', [PaginaController::class, 'upload'])->name('image.upload');

