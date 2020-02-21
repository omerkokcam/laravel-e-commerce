<?php

namespace App\Http\Controllers;

use App\Models\Siparis;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OdemeController extends Controller
{
    public function index(){
        if(!auth()->check()){
            return redirect()->route('kullanici.oturumac')
                ->with('mesaj_tur','info')
                ->with('mesaj','Ödeme işlemi için oturum açmalısınız.');


        }
        else if(count(Cart::content()) == 0){

                return redirect()->route('anasayfa')->with('mesaj_tur','info')->with('mesaj','Ödeme işlemi yapabilmeniz için sepetinizde en az bir ürün bulunmalıdır.');
        }

        $kullanici_detay = auth()->user()->kullanici_detay;


        return view('odeme',compact('kullanici_detay'));
    }
    public function odemeyap(){
        $siparis = \request()->all();
        $siparis['sepet_id'] = session('aktif_sepet_id');
        $siparis['banka'] = 'AKBANK';
        $siparis['taksit_sayisi'] = 1;
        $siparis['durum'] = 'Siparisiniz alındı.';
        $siparis['siparis_tutari'] = Cart::totaL();

        Siparis::create($siparis);
        Cart::destroy();
        session()->forget('aktif_sepet_id');


        return redirect()->route('siparisler')
                         ->with('mesaj','Ödeme başarılı bir şekilde yapıldı.')
                         ->with('mesaj_tur','success');


    }
}
