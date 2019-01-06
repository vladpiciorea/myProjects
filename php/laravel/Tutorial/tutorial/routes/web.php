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
    // return view('welcome');
    echo "Exemplu";

});
Route::get('contact', function () {
    // return view('welcome');
    echo " Completeaza forumlarul";
    echo '
    <form method="POST" action="contact">
        <input type="hidden" name="_token" value="'.csrf_token(). '">
        <input type="hidden" value="DELETE" name="_method">
        <input type="submit">
    </form>';
});

// Tipuri de ruta GET, POST,PUT, DELETE

// Create, Read, Update, Delete CRUD

// GET -> READ
// POST -> CREATE
// PUT -> Update
// DELETE -> Ddelete

Route::post('contact', function() {
    echo 'Formularul a fost trimis';
});
Route::put('contact', function() {
    echo 'Formularul a fost trimis! Acesta este put!';
});
Route::delete('contact', function() {
    echo 'Formularul a fost trimis! Acesta este delete!';
});