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

Route::group(['middleware'=>['auth'],'prefix'=>'admin',], function(){ 

	Route::get('/', function () {
	    return view('index');
	})->name('home');

	Route::resource('users','UsersController');
	Route::post('userlogout','UsersController@logout')->name('userlogout');
	Route::resource('projects','ProjectsController');
	Route::resource('industries','IndustriesController');
	Route::resource('departments','DepartmentsController');
	Route::resource('designations','DesignationsController');
	Route::resource('clients','ClientsController');
	Route::resource('project-categories','ProjectCategoriesController');
	Route::resource('task-categories','TaskCategoriesController');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
