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


//Route::get('/', 'PostsController@index');
Route::get('/logout', 'LoginController@logout');//ruta za logout

Route::prefix('login')->group(function() {
    Route::get('/', 'LoginController@index')->name('login');//ruta vracanje view, pomocu metode index() u LoginController.php
    Route::post('/', 'LoginController@login');//
});


Route::prefix('/register')->group(function() {
    Route::get('/', 'RegisterController@create');//ruta za registrovanje korisnika
    Route::post('/', 'RegisterController@store');
});

Route::get('/posts', 'PostsController@index'); //ruta za sve knjige

//prefix posts za sve rute u kojima imamo prefix posts, da ne bi ponavljali u svakoj ruti posts
Route::group(['prefix' => 'posts', 'middleware' => ['auth']], function () { //sve rute smo zastitili sa middleware=>auth, korisnik koji nije ulogovan ne moze da kreira post..., i ovako ubuduce da definisemo prefix
    Route::get('/create', 'PostsController@create');//iz postscontrollera pozivamo metodu create, ovo mora biti iznad id i prazne rute, ako nismo ulogovani mozemo da pristupimo samo stranici posta, ne mozemo da kreiramo post ako nismo ulogovani
    Route::post('/', 'PostsController@store');
    Route::get('/{id}', 'PostsController@show');//ruta za knjigu po id
    

    Route::prefix('/{postId}/comments')->group(function () { //prefix za rute
        Route::post('/', 'CommentsController@store'); //daj mi post tog $id i njegove komentare
        Route::post('/{commentId}', 'CommentsController@destroy'); //ruta za brisanje komentara
    });

});


Route::get('/users/{id}', 'UsersController@show'); //ruta za datog korisnika da se prikazu svi njegovi postovi

Route::get('/posts/tags/{tag}', 'TagsController@index'); // {tag} ->prosledili smo ceo objekat za rutu; ruta za tagove
