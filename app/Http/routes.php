<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|


Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/','laboratorioController@index')->name('laboratorios');

Route::get('/laboratorio/{id}','laboratorioController@laboratorio')->name('laboratorio');

Route::auth();
Route::get('/laboratorio','laboratorioController@index');
Route::get('/cadastro/{id?}','laboratorioController@cadastro')->name('cadastro');
Route::post('/cadastro','laboratorioController@gravar')->name('gravar-cadastro');
Route::get('/home', 'HomeController@index');
Route::post('/uploadImagem','laboratorioController@uploadPanoramicView')->name('uploadPanoramicView');
Route::delete('/equipamento','laboratorioController@excluirEquipamento')->name('excluir-equipamento');
Route::get('/excluir/{id}','laboratorioController@excluirTudo')->name('excluir-tudo');
