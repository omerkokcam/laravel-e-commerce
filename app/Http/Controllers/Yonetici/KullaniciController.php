<?php

namespace App\Http\Controllers\Yonetici;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KullaniciController extends Controller
{
//    public function oturumac()
//    {
//
//        if (request()->isMethod('POST')) {
//            $this->validate(request(), [
//                'email' => 'required|email',
//                'sifre' => 'required',
//
//            ]);
//
//            $credentials = [
//                'email' => request()->get('email'),
//                'password' => request()->get('sifre'),
//                'yonetici_mi' => 1
//            ];
//            if (auth()->attempt($credentials, request()->has('benihatirla'))) {
//                return redirect()->route('yonetici.anasayfa');
//            } else {
//                //giremezzse oturum ac sayfasına geri donecek ve bilgileri withInput() sayesinde kaybolmayacak.
//                return back()->withInput()->withErrors(['email' => ' EMAIL ADRESİNİZİ VEYA PAROLANIZI KONTROL EDİNİZ.']);
//            }
//        }
//
//
//
//        return view('yonetici.oturumac');
//    }
//    public function oturumukapat(){
//        auth()->logout();
//        request()->session()->flush();
//        request()->session()->regenerate();
//
//        return redirect()->route('anasayfa');
//    }

}
