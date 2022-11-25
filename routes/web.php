<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ArchivosPaginaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutenticarController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaginaController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SeccionController;
use App\Http\Controllers\SubSeccionController;
use App\Http\Controllers\RepositorioController;
use Spatie\Activitylog\Models\Activity;

// Route::get('/', function () {
//     return view('welcome');
// })->name('inicio');

Route::get('/', [SeccionController::class,'bienvenida'])->name('inicio');


// Vista al dashboard ó tablero principal
Route::get('tablero', [HomeController::class, 'index'])->middleware('can:admin.dashboard')->name('dashboard');

/* Rutas para iniciar sesión y cerrar sesión */
Route::get('iniciar-sesion', [AutenticarController::class, 'credenciales'])->name('login');
Route::post('validar', [AutenticarController::class, 'autenticar'])->name('validar');
Route::get('salir', [AutenticarController::class, 'salida'])->name('salir');

Route::resource('roles', RoleController::class)->names('roles');

// Route::get('buscar-paginas', [RoleController::class, 'role'])

// Ruta con ajax para obtener toda la data de paginas con datatables
Route::get('roles-data', [RoleController::class, 'rolesDatatables'])->name('roles-data');

// Ruta tipo resource para usuarios
Route::resource('usuarios', UsuarioController::class)->names('usuarios');

// Ruta tipo resource para usuarios
Route::resource('users', UserController::class)->names('users');

// Ruta con ajax para obtener toda la data de usuarios con datatables
Route::get('usuarios-data', [UsuarioController::class, 'usersDatatables'])->name('usuarios-data');

// Ruta con ajax para obtener toda la data de usuarios con datatables
Route::get('users-data', [UserController::class, 'usersDatatables'])->name('users-data');

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
// Ruta para el listado de páginas que tiene asignadas un empleado
Route::get('listado-paginas',[PaginaController::class, 'paginasEmpleados'])->name('paginas.paginas-empleados');

// Ruta con ajax para obtener toda la data de archivos de una página con datatables
Route::get('paginas-data-archivos', [ArchivosPaginaController::class, 'paginasArchivosDatatables'])->name('paginas-data-archivos');

// Ruta con AJAX para encontrar archivos dentro con base a una poágina en especifica
Route::get('paginas-archivos-check', [ArchivosPaginaController::class, 'check'])->name('paginas-archivos.paginas-archivos-check');

// Ruta resource secion de inicio (welcome)
Route::resource('seccion-inicio', SeccionController::class)->names('seccion-inicio');

// Ruta con ajax para obtener toda la data de usuarios con datatables
Route::get('seccion-inicio-data', [SeccionController::class, 'seccionesDatatables'])->name('seccion-inicio-data');

//Ruta resource para las subsecciones que tenga una seccion de inicio
Route::resource('subseccion', SubSeccionController::class)->names('subseccion');

// Ruta resource para las actividades de los logs
Route::resource('activity-logs', ActivityLogController::class)->names('activity-logs');

// Ruta con ajax para obtener toda la data de archivos de una activitylogs con datatables
Route::get('activity-logs-data', [ActivityLogController::class, 'activityLogsDatatables'])->name('activity-logs-data');

Route::get('prueba', function() {
   // dd(session()->all());
   // return Activity::all();
   return Activity::orderBy('id','desc')->get();
   });

// Ruta resource para el repositorio de archivos
Route::resource('repositorio', RepositorioController::class)->names('repositorios');

// Ruta con ajax para obtener toda la data de paginas con datatables
Route::get('repositorios-data', [RepositorioController::class, 'repositoriosDatatables'])->name('repositorios-data');

// Ruta con ajax para obtener toda la data de paginas con datatables
Route::get('paginas-data', [PaginaController::class, 'paginasDatatables'])->name('paginas-data');

// Ruta get para visualziar las páginas
Route::get('{pagina}', [PaginaController::class, 'tipoPagina'])->name('pagina');

// Ruta para subir imagen
Route::post('image/upload', [PaginaController::class, 'upload'])->name('image.upload');

// Ruta para mostrar la vista principal de archivos de una página
Route::get('paginas/{pagina}/archivos',[ArchivosPaginaController::class, 'index'])->name('paginas.archivos');


// Ruta resource para el CRUD de archivos
Route::resource('archivos', ArchivosPaginaController::class)->names('paginas-archivos');


// ruta para crear archivos de paginas
Route::get('archivos/create/{pagina}/archivo', [ArchivosPaginaController::class, 'create'])->name('paginas-archivos.create');

// Ruta para ajax - buscar un paginas con select2 
// Route::get('pagina-search', [RoleController::class, 'paginaSearch'])->name('paginas.paginaSearch');