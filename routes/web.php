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


//-------------------------------------------------------------------------------
Route::group(['prefix'=>'yonetici', 'middleware' => 'yonetici','namespace'=>'Yonetici'],function () {
    Route::get('/', 'AnasayfaController@index')->name('yonetici.anasayfa');
    Route::get('/oturumukapat','KullaniciController@oturumukapat')->name('yonetici.oturumukapat');


    Route::group(['prefix'=>'kullanici'],function (){
        Route::match(['get','post'],'/','KullaniciController@index')->name('yonetici.kullanici');
        Route::get('/duzenle/{id}','KullaniciController@form')->name('yonetici.kullanici.duzenle');
        Route::post('/kayit/{id?}','KullaniciController@kayit')->name('yonetici.kullanici.kayit');
        Route::get('/sil/{id}','KullaniciController@sil')->name('yonetici.kullanici.sil');
        Route::get('/yeni','KullaniciController@form')->name('yonetici.kullanici.yeni');
    });


    Route::group(['prefix'=>'kategori'],function (){
        Route::match(['get','post'],'/','KategoriController@index')->name('yonetici.kategori');
        Route::get('/duzenle/{id}','KategoriController@form')->name('yonetici.kategori.duzenle');
        Route::post('/kayit/{id?}','KategoriController@kayit')->name('yonetici.kategori.kayit');
        Route::get('/sil/{id}','KategoriController@sil')->name('yonetici.kategori.sil');
        Route::get('/yeni','KategoriController@form')->name('yonetici.kategori.yeni');
    });


    Route::group(['prefix'=>'urun'],function (){
        Route::match(['get','post'],'/','UrunController@index')->name('yonetici.urun');
        Route::get('/duzenle/{id}','UrunController@form')->name('yonetici.urun.duzenle');
        Route::post('/kayit/{id?}','UrunController@kayit')->name('yonetici.urun.kayit');
        Route::get('/sil/{id}','UrunController@sil')->name('yonetici.urun.sil');
        Route::get('/yeni','UrunController@form')->name('yonetici.urun.yeni');
    });





});


