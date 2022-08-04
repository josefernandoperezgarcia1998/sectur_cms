<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutenticarController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;


Route::get('/', function () {
    return view('welcome');
})->name('inicio');


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

// Ruta tipo resource para usuarios
Route::resource('menus', MenuController::class)->names('menus');

// Ruta con ajax para obtener toda la data de usuarios con datatables
Route::get('menus-data', [MenuController::class, 'menusDatatables'])->name('menus-data');

Route::post('slug-check', [MenuController::class, 'check'])->name('menu.register-check');