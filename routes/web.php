<?php

use Facade\FlareClient\Api;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|*/

//sesiones - Vistas
Route::get('/', "usuario@inicio");
Route::get('/bienvenido', ["middleware"=>"filtrador", "uses" => "usuario@bienvenido"]);

//ejemplo
Route::get('/ejemplo',function() {
    return view('ejemplo');
});
Route::get('test', function () {
    event(new App\Events\MyEvent('Welcome'));
    return "Event has been sent!";
});

//sesiones peticiones
Route::post('/getsesion','usuario@logeo');
Route::get('/logout','usuario@logout');

//aplicacion de google
Route::get('/aplicacion', "aplicacioncontroller@apigoogle");
Route::get('/ss', "aplicacioncontroller@ss");
Route::get('/a', "aplicacioncontroller@geocoding");

Route::get('/act', "formularioscontroller@act");
Route::get('/act2', "formularioscontroller@act2");
Route::get('/act3', "formularioscontroller@act3");
Route::get('/acvproc', "formularioscontroller@acvproc");
Route::get('/actestudi', "formularioscontroller@actestudi");



//Consulta en django
Route::post('/busqueda', "aplicacioncontroller@busqueda");
Route::get('/calor', "aplicacioncontroller@calor");

Route::get('/colorbar', "pdfcontroller@colorbar");


//cotizando

Route::get('/cotizantes', "aplicacioncontroller@cotizantes");
Route::get('/entregados', "aplicacioncontroller@entregados");
Route::get('/cotizando/{id}', "formularioscontroller@cotizando1");
Route::get('/proyecto/{id}', "formularioscontroller@proyecto");
Route::get('/proyect/{id}', "formularioscontroller@proyect");
Route::get('/actproyecto', "routerwebController@actproyecto");
Route::post('/crear', "formularioscontroller@cotizando");

//Diagnostico
Route::get('/diagnostico', 'aplicacioncontroller@diagnostico');

//proyeccion
Route::get('/proyeccion', "formularioscontroller@proyeccion");
Route::get('/pesos', "formularioscontroller@pesos");


//pdf

Route::get('/pdfs', "pdfcontroller@pdfs");
Route::get('/pdf_proyecto', "pdfcontroller@pdf_proyecto");


//correo

Route::post('/correo', "correocontroller@correo1");
Route::post('/correo2', "correocontroller@correopdf2");
Route::get('/correos', "correocontroller@correo1s");
Route::post('/correopdf1', "correocontroller@correopdf1");
Route::post('/correopdf4', "correocontroller@correopdf4");


Route::get('/imgs', "pdfcontroller@img");
Route::get('/imgd', "pdfcontroller@imgd");
Route::get('/as', "aplicacioncontroller@as");

Route::get('/abc', "a@a1");





