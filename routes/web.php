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


Route::get('/', 'PostsController@index');

//prefix posts za sve rute u kojima imamo prefix posts, da ne bi ponavljali u svakoj ruti posts
Route::prefix('posts')->group(function () {
    Route::get('/create', 'PostsController@create');//iz postscontrollera pozivamo metodu create, ovo mora biti iznad id i prazne rute
    Route::post('/', 'PostsController@store');
    Route::get('/{id}', 'PostsController@show');//ruta za knjigu po id
    Route::get('/', 'PostsController@index'); //ruta za sve knjige

    Route::prefix('/{postId}/comments')->group(function () { //prefix za rute
        Route::post('/', 'CommentsController@store'); //daj mi post tog $id i njegove komentare
        Route::post('/{commentId}', 'CommentsController@destroy'); //ruta za brisanje komentara
    });

});
