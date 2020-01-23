<?php

namespace App\Http\Controllers;

use App\Models\Sepet;
use App\Models\SepetUrun;
use App\Models\Urun;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SepetController extends Controller
{



    public function index()
    {
        if(auth()->check()){
            $kontrol = SepetUrun::count();
            if($kontrol == 0){
                Cart::destroy();
            }

        }

        return view('sepet');
    }
    public function ekle()
    {
        //urunun sepete eklenmesi
        $urun = Urun::find(request('id'));
        $cartItem = Cart::add($urun->id, $urun->urun_adi, 1, $urun->fiyati);

        if (auth()->check()) {   //eger zaten kullanici bulunuyorsa
            $aktif_sepet_id = session('aktif_sepet_id');


            //sepet kaydı oluşturalım
            if (!isset($aktif_sepet_id)) {
                $aktif_sepet = Sepet::create([
                    //kayıt oluşturuyoruz
                    'kullanici_id' => auth()->id()
                ]);
                //veri tabanında oluşan kaydın id degerini alıyoruz
                $aktif_sepet_id = $aktif_sepet->id;
                session()->put('aktif_sepet_id', $aktif_sepet_id);

            }

            $urun_kontrol = SepetUrun::where('sepet_id', $aktif_sepet_id)->where('urun_id', $urun->id)->first();
            if (count($urun_kontrol) > 0)
            {
                $urun_kontrol->delete();
            }

            SepetUrun::create(
                ['sepet_id'=>$aktif_sepet_id,'urun_id'=>$urun->id, 'adet'=>$cartItem->qty,'tutar'=>$urun->fiyati*$cartItem->qty,'durum'=>'Beklemede']
                );



        }

            return redirect()->route('sepet');

    }
    public function kaldir($rowId)
    {


        if (auth()->check()) {
            //kullanici oturum acmıs mı kontrol ediyor
            $aktif_sepet_id = session('aktif_sepet_id');
            //cart kütüphanesinden özelliklerin hepsini çekiyor
            $cartItem = Cart::get($rowId);
            SepetUrun::where('sepet_id', $aktif_sepet_id)->where('urun_id', $cartItem->id)->delete();


        }
        Cart::remove($rowId);

        return redirect()->route('sepet')
            ->with('mesaj_tur', 'success')
            ->with('mesaj', 'Ürün sepetten kaldırıldı.');
    }
    public function bosalt(){
        if(auth()->check()){
            //kullanici oturum acmıs mı kontrol ediliyor
            $aktif_sepet_id = session('aktif_sepet_id');
            SepetUrun::where('sepet_id',$aktif_sepet_id)->delete();

        }

        Cart::destroy();
        return redirect()->route('sepet')
            ->with('mesaj_tur','success')
            ->with('mesaj','Ürünler sepetten kaldırıldı.');


    }
    public function guncelle($rowId)
    {
        Cart::update($rowId,request('adet'));

        session()->flash('mesaj_tur','success');
        session()->flash('mesaj','Adet Bilgisi Güncellendi');
        return response()->json(['success'=>true]);


    }

}
