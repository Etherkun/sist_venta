<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\GraficasController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

//Usuarios
Route::resource('sistema/usuario', UserController::class);
Route::patch('/sistema/usuario/update/{id}', [UserController::class,'update'])->name('sistema.usuario.update');
Route::get('/sistema/usuario/show/{id}', [UserController::class,'show'])->name('sistema.usuario.show');

//Clientes
Route::resource('sistema/cliente', ClienteController::class);
Route::patch('/sistema/cliente/update/{id}', [ClienteController::class,'update'])->name('sistema.cliente.update');

//Proveedor
Route::resource('sistema/proveedor', ProveedorController::class);
Route::patch('/sistema/proveedor/update/{id}', [ProveedorController::class,'update'])->name('sistema.proveedor.update');

//Sucursal
Route::resource('sistema/sucursal', SucursalController::class);
Route::patch('/sistema/sucursal/update/{id}', [SucursalController::class,'update'])->name('sistema.sucursal.update');

//Producto
Route::resource('sistema/producto', ProductoController::class);
Route::patch('/sistema/producto/update/{id}', [ProductoController::class,'update'])->name('sistema.producto.update');

//Venta
Route::resource('sistema/venta', VentaController::class);
Route::patch('/sistema/venta/update/{id}', [VentaController::class,'update'])->name('sistema.venta.update');
Route::get('/sistema/venta/show/{id}', [VentaController::class,'show'])->name('sistema.venta.show');
Route::get('/sistema/venta/show/{id}', [VentaController::class,'imprimir_ne_pdf'])->name('sistema.venta.show');

//Graficas
Route::get('sistema/grafico', [GraficasController::class,'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout', function () {
    return abort(404);
});
