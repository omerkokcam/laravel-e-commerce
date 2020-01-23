<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class OdemeController extends Controller
{
    public function index(){
        if(!auth()->check()){
            return redirect()->route('kullanici.oturumac')
                ->with('mesaj_tur','info')
                ->with('mesaj','Ödeme işlemi için oturum açmalısınız.');


        }
        elseif(count(Cart::content())==0){

                return redirect()->route('anasayfa')->with('mesaj_tur','info')->with('mesaj','Ödeme işlemi yapabilmeniz için sepetinizde en az bir ürün bulunmalıdır.');
        }
        return view('odeme');
    }
}
