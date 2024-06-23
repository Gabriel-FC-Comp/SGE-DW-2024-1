<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CidadeController;

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

//Route::get('/', function () {
    //return view('welcome');
//    return view('main');
//});
//Aqui redireciona / para o metodo 'index', e 
//index adquire $cidades e 
//redireciona para main
Route::get('/', [CidadeController::class, 'index']);

//Aqui redireciona para o metodo 'search', e
//'search' adquire $cidades e 
//redireciona para main
Route::get('/cidades/{type}/{val}/search', [CidadeController::class, 'search']);

//Aqui redireciona para o metodo 'add', e
//'add' adiciona a cidades e 
//redireciona para main
Route::post('/cidades/add', [CidadeController::class, 'add_city']);

//Aqui redireciona para o metodo 'remove', e
//'rmv' remove a cidades e 
//redireciona para main
Route::post('/cidades/rmv', [CidadeController::class, 'remove_city']);