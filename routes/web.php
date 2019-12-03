<?php


Route::get('/','IndexController@IndexPrikaz')->name('index');
Route::get('/kontakt','KontaktController@PrikazKontakt')->name('kontakt');
Route::get('/registracija','RegistracijaController@RegistracijaPrikaz')->name('registracija');

Route::post('/registracija','RegistracijaController@PosRegistracija');
Route::get('/aktivacija/{token}','RegistracijaController@AktivacijaNaloga');

Route::post('/logovanje','RegistracijaController@Logovanje')->name('logovanje');
