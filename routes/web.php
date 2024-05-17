<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
});

Route::get('/principal', function () {
    return view('principal');
})->name('principal');

Route::get('/index', function () {
    return view('index');
})->name('index');

Route::get('/docentes', function () {
    return view('docentes');
})->name('docentes');

Route::get('/asignaturas', function () {
    return view('asignaturas');
})->name('asignaturas');

Route::get('/salones', function () {
    return view('salones');
})->name('salones');

Route::get('/horarios', function () {
    return view('horarios');
})->name('horarios');


Route::get('/inicio', function () {
    return view('inicio');
})->name('inicio');

Route::get('/crear', function () {
    return view('crear');
})->name('crear');
