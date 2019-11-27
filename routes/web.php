<?php


Route::get('/','IndexController@IndexPrikaz')->name('index');
Route::get('/kontakt','KontaktController@PrikazKontakt')->name('kontakt');
Route::get('/registracija','RegistracijaController@RegistracijaPrikaz')->name('registracija');
