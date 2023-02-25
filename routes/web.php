<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\LangController;


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
    return view('home');
});

//ruta 'extra' que utilizaremos para hacer show (detalle) de producto (sin parametro productoID, la traduccion dinamica no puede funcionar)
Route::get('Producto/{slug}', [ProductoController::class, 'show_by_slug'])->name('Producto.show_slug'); 

//la misma ruta que la de arriva pero con el parametro de la id de producto (con parametro productoID, la traduccion dinamica funciona)
Route::get('Producto/{slug}/{productoID}', [ProductoController::class, 'show_by_slug_id'])->name('Producto.show_slug_id'); 

//el resource de producto, con todas las rutas apuntando hacia todos los metodos
Route::resource('Producto', ProductoController::class); 


Route::get('change_lang/{lang}', [LangController::class, 'change'])->name('changeLang');








