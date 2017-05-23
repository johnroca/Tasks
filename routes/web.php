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

Route::get('/tasks', [
    'as' => 'tasks',
    'uses' => 'TaskController@index'
]);

Route::get('/tasks/create', [
    'as' => 'tasks.create',
    'uses' => 'TaskController@create'
]);

Route::post('/tasks/create', [
    'as' => 'tasks.create',
    'uses' => 'TaskController@save'
]);

Route::get('/tasks/edit/{id}', [
    'as' => 'tasks.edit',
    'uses' => 'TaskController@edit'
]);

Route::post('/tasks/update', [
    'as' => 'tasks.update',
    'uses' => 'TaskController@update'
]);

Route::post('/tasks/completion', [
    'as'    => 'tasks.completion',
    'uses'  => 'TaskController@completion'
]);

Route::post('/tasks/delete', [
    'as'    => 'tasks.delete',
    'uses'  => 'TaskController@delete'
]);

