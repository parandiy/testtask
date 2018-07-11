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

Route::get( '/',
	function () {
		return view( 'welcome' );
	} );

Route::get( '/', 'IndexController@index' )
     ->name( 'front_push' );
Route::get( '/push', 'IndexController@push' )
     ->name( 'front_push' );
Route::get( '/lists', 'IndexController@lists' )
     ->name( 'front_lists' );