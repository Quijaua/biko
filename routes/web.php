<?php

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
    return view('welcome');
});

// ROUTES FOR NUCLEOS MANAGEMENT
Route::get('nucleos', 'NucleoController@index')->middleware('permissions');
Route::get('nucleos/details/{id}', 'NucleoController@details')->middleware('permissions');
Route::get('nucleos/add', 'NucleoController@showForm')->middleware('permissions');
Route::post('nucleos/create', 'NucleoController@create')->middleware('permissions');
Route::get('nucleos/edit/{id}', 'NucleoController@edit')->middleware('permissions');
Route::post('nucleos/update/{id}', 'NucleoController@update')->middleware('permissions');
Route::get('nucleos/disable/{id}', 'NucleoController@disable')->middleware('permissions');
Route::get('nucleos/enable/{id}', 'NucleoController@enable')->middleware('permissions');
Route::any('nucleos/search', 'NucleoController@search')->middleware('permissions');

// ROUTES FOR ALUNOS MANAGEMENT
Route::get('alunos', 'AlunosController@index')->middleware('permissions');
Route::get('alunos/details/{id}', 'AlunosController@details')->middleware('permissions');
Route::get('alunos/add', 'AlunosController@showForm')->middleware('permissions');
Route::post('alunos/create', 'AlunosController@create')->middleware('permissions');
Route::get('alunos/edit/{id}', 'AlunosController@edit')->middleware('permissions');
Route::post('alunos/update/{id}', 'AlunosController@update')->middleware('permissions');
Route::get('alunos/disable/{id}', 'AlunosController@disable')->middleware('permissions');
Route::get('alunos/enable/{id}', 'AlunosController@enable')->middleware('permissions');
Route::any('alunos/search', 'AlunosController@search')->middleware('permissions')->name('alunos/search');
Route::post('alunos/familiares/add', 'AlunoInfoFamiliaresController@add')->name('alunos/familiares/add');
Route::get('alunos/export/', 'AlunosController@export')->name('alunos/export/');

// ROUTES FOR COORDENADORES MANAGEMENT
Route::get('coordenadores', 'CoordenadoresController@index')->middleware('permissions');
Route::get('coordenadores/details/{id}', 'CoordenadoresController@details')->middleware('permissions');
Route::get('coordenadores/add', 'CoordenadoresController@showForm')->middleware('permissions');
Route::post('coordenadores/create', 'CoordenadoresController@create')->middleware('permissions');
Route::get('coordenadores/edit/{id}', 'CoordenadoresController@edit')->middleware('permissions');
Route::post('coordenadores/update/{id}', 'CoordenadoresController@update')->middleware('permissions');
Route::get('coordenadores/disable/{id}', 'CoordenadoresController@disable')->middleware('permissions');
Route::get('coordenadores/enable/{id}', 'CoordenadoresController@enable')->middleware('permissions');
Route::any('coordenadores/search', 'CoordenadoresController@search')->name('coordenadores/search');

// ROUTES FOR PROFESSORES MANAGEMENT
Route::get('professores', 'ProfessoresController@index')->middleware('permissions');
Route::get('professores/details/{id}', 'ProfessoresController@details')->middleware('permissions');
Route::get('professores/add', 'ProfessoresController@showForm')->middleware('permissions');
Route::post('professores/create', 'ProfessoresController@create')->middleware('permissions');
Route::get('professores/edit/{id}' , 'ProfessoresController@edit')->middleware('permissions');
Route::post('professores/update/{id}', 'ProfessoresController@update')->middleware('permissions');
Route::get('professores/disable/{id}', 'ProfessoresController@disable')->middleware('permissions');
Route::get('professores/enable/{id}', 'ProfessoresController@enable')->middleware('permissions');
Route::any('professores/search', 'ProfessoresController@search')->middleware('permissions')->name('professores/search');

// PROTECTED ROUTES
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
