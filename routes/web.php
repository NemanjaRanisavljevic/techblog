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

Route::get('/single-post/{id}','SinglePostController@GetIdSingle')->name('single');
Route::post('/single-post','SinglePostController@DeleteKomentara');

Route::get('/kat-nav/{id}','IndexController@PrikazKategorijaNav');
Route::get('/kat-all/{id}','IndexController@GetSvihPostovaZaKategoriju')->name('kat-all');

Route::post('/komentar','SinglePostController@InsertKomentara');
Route::post('/kontakt','KontaktController@SlanjeEmaila')->name('kontakt');


Route::get('/admin','RegistracijaController@AdminPrikazKorisnika')->name('admin-panel');
Route::get('/admin/{id}','RegistracijaController@GetKorisnikId');
Route::post('/admin','RegistracijaController@AdminAddKorisnika');
Route::put('/admin/{id}','RegistracijaController@BrisanjeKorisnika');
Route::put('/admin-edit','RegistracijaController@AdminEditKorinik')->name('admin-edit');

Route::get('/admin-kategorije','AdminController@AdminPrikazKategorija')->name('admin-kategorije');
Route::post('/admin-kategorije','AdminController@AdminAddKategorije');
Route::get('/admin-kategorije/{id}','AdminController@AdminGetKategorijeId');
Route::put('/admin-kategorije','AdminController@AdminEditKategorije');
Route::post('/admin-kategorije/{id}','AdminController@AdminBrisanjeKategorije');

Route::get('/admin-post','PostController@GetAllAdmin')->name('admin-post');
Route::get('/admin-post/{id}','PostController@GetIdPost');
Route::put('/admin-post','PostController@EditPost');
Route::post('/admin-post','PostController@DeletePost');


Route::get('/admin-uloge','UlogeController@GetAllUloge')->name('admin-uloge');
Route::get('/admin-uloge/id','UlogeController@GetSingle');
Route::post('/admin-uloge','UlogeController@InsertUloge');
Route::put('/admin-uloge','UlogeController@EditUloge');
Route::post('/admin-uloge/{id}','UlogeController@DeleteUloge');