<?php


Route::get('/','IndexController@IndexPrikaz')->name('index');
Route::get('/kontakt','KontaktController@PrikazKontakt')->name('kontakt');
Route::get('/registracija','RegistracijaController@RegistracijaPrikaz')->name('registracija');

Route::post('/registracija','RegistracijaController@PosRegistracija');
Route::get('/aktivacija/{token}','RegistracijaController@AktivacijaNaloga');

Route::post('/logovanje','RegistracijaController@Logovanje')->name('logovanje');
Route::get('/logout','RegistracijaController@Logout')->name('logout');

Route::get('/post','PostController@PostPrikaz')->name('post');
Route::post('/post','PostController@InsertPosta');

Route::get('/single-post/{id}','SinglePostController@GetIdSingle');

Route::get('/kat-nav/{id}','IndexController@PrikazKategorijaNav');
