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

Route::get('/', 'SiteController@index')->name('home');
Route::post('/cadastrarurl', 'SiteController@cadastrarUrl')->name('cadastrarurl');
Route::get('/url/{id}/excluir', 'SiteController@destroy')->name('parceiros_destroy');

Route::get('/mail', 'SiteController@mail')->name('mail');

Route::get('/logconsultas', 'SiteController@logConsultas')->name('logconsultas');

Route::get('/notificacao', 'SiteController@notificacao')->name('notificacao');
Route::post('/cadastraremail', 'SiteController@cadastrarEmail')->name('cadastrarEmail');