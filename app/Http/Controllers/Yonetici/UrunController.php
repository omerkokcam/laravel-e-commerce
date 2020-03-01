<?php

namespace App\Http\Controllers\Yonetici;

use App\Models\Kategori;
use App\Models\Siparis;
use App\Models\Urun;
use App\Models\UrunDetay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class UrunController extends Controller
{
    public function index(){
        if(\request()->filled('aranan')){

            $aranan = \request('aranan');
            $liste = Urun::where('urun_adi','like' ,"%".$aranan."%")
                    ->orWhere('aciklama','like',"%".$aranan."%")
                    ->paginate(8);
            \request()->flash();

        }
        else{
            $liste = Urun::orderByDesc('id')->paginate(8);
        }
        return view('yonetici.urun.index',compact('liste'));

    }

    public function ara(Request $request){
        if (isset($request->aranan)){
            $aranan = $request->aranan;
            $sonuc = Urun::where('urun_adi',"like","%".$aranan."%")->limit(5)->get();
            return $sonuc;
        }
        return null;
    }

    public function form($id = 0){
        $entry = new Urun;

        if($id > 0 ){
            $entry = Urun::find($id);
            $urun_kategorileri = $entry->kategoriler()->pluck('kategori_id')->all();

        }
        $kategoriler = Kategori::all();
        return view('yonetici.urun.form',compact('entry','kategoriler','urun_kategorileri'));
    }
    public function kayit($id = 0){

        $this->validate(\request(),[
           'urun_adi'=>'required',
            'slug'=>'required',
            'fiyati'=>'required|numeric',
            'aciklama'=>'required'
        ]);
        $kategoriler = \request('kategoriler');

        if($id > 0 ){
            //guncelleme yap
            $entry = Urun::find($id);
            $entry->update([
                'urun_adi'=>request('urun_adi'),
                'slug'=>request('slug'),
                'fiyati'=>request('fiyati'),
                'aciklama'=>request('aciklama')

                ]);
            $entry->detay()->update([
                'goster_slider'=>\request('goster_slider'),
                'goster_one_cikan'=>\request('goster_one_cikan'),
                'goster_gunun_firsati'=>\request('goster_gunun_firsati'),
                'goster_cok_satan'=>\request('goster_cok_satan'),
                'goster_indirimli'=>\request('goster_indirimli')
                ]);


            $entry->kategoriler()->sync($kategoriler);
        }

        else{
            //yeni kayıt yap
           $entry = Urun::create([
                'urun_adi'=>request('urun_adi'),
                'slug'=>request('slug'),
                'fiyati'=>request('fiyati'),
                'aciklama'=>request('aciklama')
            ]);
            $entry->detay()->create([
                'urun_id' => $entry->id,
                'goster_slider'=>\request('goster_slider'),
                'goster_one_cikan'=>\request('goster_one_cikan'),
                'goster_gunun_firsati'=>\request('goster_gunun_firsati'),
                'goster_cok_satan'=>\request('goster_cok_satan'),
                'goster_indirimli'=>\request('goster_indirimli')
            ]);

            $entry->kategoriler()->attach($kategoriler);
        }

        if(request()->hasFile('urun_resmi')){
            $this->validate(\request(),[
               'urun_resmi'=>'image|mimes:png,jpg,jpeg,gif,jfif,jpe|max:4096'

            ]);
            $urun_resmi = \request()->file('urun_resmi');
//            $urun_resmi->extension();//urun resmininin uzantısını çekmek için extension() kullanılır.
//            $urun_resmi -> getClientOriginalName();//bilgisayardaki adını çekmeyi sağlar.
//            $urun_resmi -> hashName();
            $dosya_adi = $entry->id . '-' .time().'.'.$urun_resmi->extension();
//            $dosya_adi = $urun_resmi->getClientOriginalName();
//            $dosya_adi = $urun_resmi->hashName();
            //urunu yukleme
            if($urun_resmi-> isValid()){
                $urun_resmi->move('uploads/urunler',$dosya_adi);

                UrunDetay::updateOrCreate(
                    ['urun_id'=>$entry->id],
                   ['urun_resmi'=>$dosya_adi]
                );

            }
        }

    return redirect()->route('yonetici.urun.duzenle',$entry->id)->with('mesaj','Güncellendi')->with('mesaj_tur','success');

    }


    public function sil($id){

        $urun = Urun::find($id);
        $urun->kategoriler()->detach();
        $urun->detay()->delete();
        $urun->delete();

        return redirect()->route('yonetici.urun')->with('mesaj','Kayıt silindi')->with('mesaj_tur','success');
    }
}
