<?php

namespace App\Http\Controllers\Yonetici;

use App\Kullanici;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function index(){


            $liste = Kategori::orderByDesc('created_at')->get();

        return view('yonetici.kategori.index',compact('liste'));
    }
    public function form($id = 0){

        $entry = new Kategori();
        if($id>0){
            $entry=Kategori::find($id);

        }
        $kategoriler = Kategori::all();

        return view('yonetici.kategori.form',compact('entry','kategoriler'));


    }

    public function kayit($id = 0)
    {
        $entry = Kategori::find($id);

        if(!request()->filled('slug')){
               $entry -> slug = Str::slug(request('kategori_adi'));
                $this->validate(request(),[
                    'ust_id' => 'required',
                    'kategori_adi' => 'required',
                    'slug' => 'required'

                ]);
            }


            if($id > 0 ){
                //guncelle

                $entry->update([

                    'kategori_adi'=> request('kategori_adi'),
                    'slug'=> request('slug'),
                ]);


            }
            else{
                //yeni kayıt

                $entry = Kategori::create([


                    'kategori_adi'=> request('kategori_adi'),

                    'slug'=> request('slug'),

                ]);
            }

            return redirect()->route('yonetici.kategori.duzenle', $entry -> id)
                ->with('mesaj',($id > 0 ? 'Kaydedildi':'Güncellendi'))
                ->with('mesaj_tur','success');



    }

    public function sil($id){
        $kategori = Kategori::find($id);
        $kategori -> urunler()->delete();
        $kategori -> delete();

        return redirect()->route('yonetici.kategori')->with('mesaj','Kayıt Silindi')->with('mesaj_tur','success');
    }
}
