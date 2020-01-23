<?php


Route::get('/','AnasayfaController@index')->name('anasayfa');


Route::get('/kategori/{slug_kategoriadi}','KategoriController@index')->name('kategori');


Route::get('/urun/{slug_urunadi}','UrunController@index')->name('urun');


Route::group(['prefix'=>'sepet'],function (){

    Route::get('/','SepetController@index')->name('sepet');
    Route::post('/ekle','SepetController@ekle')->name('sepet.ekle');
    Route::delete('/kaldir/{rowId}','SepetController@kaldir')->name('sepet.kaldir');
    Route::delete('/bosalt','SepetController@bosalt')->name('sepet.bosalt');
    Route::patch('/guncelle/{rowId}','SepetController@guncelle')->name('sepet.guncelle');

});


Route::group(['middleware' => 'auth'],function(){



    Route::get('/siparisler','SiparisController@index')->name('siparisler');
    Route::get('/siparisler/{id}','SiparisController@detay')->name('siparis');



});



Route::get('/odeme','OdemeController@index')->name('odeme');




Route::post('/ara','UrunController@ara')->name('urun_ara');
Route::get('/ara','UrunController@ara')->name('urun_ara');





Route::group(['prefix'=>'kullanici'],function (){
    Route::get('/oturumac','KullaniciController@giris_form')->name('kullanici.oturumac');
    Route::post('/oturumac','KullaniciController@giris')->name('kullanici.oturumac');
    Route::get('/kaydol','KullaniciController@kaydol_form')->name('kullanici.kaydol');
    Route::post('/kaydol','KullaniciController@kaydol')->name('kullanici.kaydol');
    Route::get('/aktiflestir/{anahtar}','KullaniciController@aktiflestir')->name('kullanici.aktiflestir');
    Route::post('/oturumukapat','KullaniciController@oturumukapat')->name('kullanici.oturumukapat');

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
