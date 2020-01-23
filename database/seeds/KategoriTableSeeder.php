<?php

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data=Kategori::create(['kategori_adi'=>'Elektronik','slug'=>'elektronik']);
        Kategori::create(['kategori_adi'=>'Bilgisayar/Tablet','slug'=>'bilgisayar-tablet','ust_id'=>$data->id]);
        Kategori::create(['kategori_adi'=>'Akıllı Telefon','slug'=>'akilli-telefon','ust_id'=>$data->id]);
        Kategori::create(['kategori_adi'=>'TV ve Ses Sistemleri','slug'=>'tv-ses-sistemleri','ust_id'=>$data->id]);
        Kategori::create(['kategori_adi'=>'Kamera','slug'=>'kamera','ust_id'=>$data->id]);

        Kategori::create(['kategori_adi'=>'Kitap, Müzik, Film, Hobi','slug'=>'kitap-muzik-film-hobi']);
        Kategori::create(['kategori_adi'=>'Mobilya,Dekorasyon','slug'=>'mobilya-dekorasyon']);
        Kategori::create(['kategori_adi'=>'Kozmetik, Kişisel Bakım','slug'=>'kozmetik-kisisel-bakim']);
        Kategori::create(['kategori_adi'=>'Giyim ve Moda','slug'=>'giyim-moda']);
        Kategori::create(['kategori_adi'=>'Anne,Bebek,Oyuncak','slug'=>'anne-bebek-oyuncak']);
        Kategori::create(['kategori_adi'=>'Oto, Bahçe, Yapı Market','slug'=>'oto-bahce-yapi-market']);
        Kategori::create(['kategori_adi'=>'Spor, Outdoor','slug'=>'spor-outdoor']);
        Kategori::create(['kategori_adi'=>'Süpermarket, Petshop','slug'=>'super-market-petshop']);
        Kategori::create(['kategori_adi'=>'Ev, Yaşam, Kırtasiye, Ofis','slug'=>'ev-yasam-kirtasiye-ofis']);

    }
}
