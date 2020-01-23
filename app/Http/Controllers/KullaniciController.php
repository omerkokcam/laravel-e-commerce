<?php

namespace App\Http\Controllers;

use App\Kullanici;
use App\Mail\KullaniciKayitMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;


class KullaniciController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('oturumukapat');
    }

    public function giris_form(){

        return view('kullanici.oturumac');
    }

    public function giris(){
        $this->validate(request(),[
            'email' => 'required|email',
            'sifre' => 'required'
        ]);

        if(auth()->attempt(['email' => request('email'),'password' => request('sifre')],request()->has('benihatirla')) ){

            request()->session()->regenerate();
            return redirect()->intended('/');
        }
        else{

            $errors = ['email' => 'Hatalı Giriş'];
            return back()->withErrors($errors);
        }
    }

    public function kaydol_form(){

        return view('kullanici.kaydol');
    }

    public function kaydol( ){

        $this->validate(request(),[
            'adsoyad' => 'required|min:5|max:60',
            'email' => 'required|email|unique:kullanici',
            'sifre' =>  'required|confirmed|min:5|max:15',


        ]);



        $kullanici = Kullanici::create([
            'adsoyad'=> request('adsoyad'),
            'email'=> request('email'),
            'sifre'=> Hash::make( request('sifre')),
            'aktivasyon_anahtari'=> Str::random(60),
            'aktif_mi'=> 0
        ]);
        Auth::login($kullanici);
        Mail::to(request('email'))->send(new KullaniciKayitMail($kullanici));

        View::share('kullanici',$kullanici);
        return redirect()->route('anasayfa');
    }



        public function aktiflestir($anahtar)
        {

            $kullanici = Kullanici::where('aktivasyon_anahtari', $anahtar)->first();
            if (isset($kullanici)) {
                Auth::login($kullanici);

                if (!is_null($kullanici)) {
                    $kullanici->aktivasyon_anahtari = null;
                    $kullanici->aktif_mi = 1;
                    $kullanici->save();
                    return redirect()->to('/')
                        ->with('mesaj_tur', 'success')
                        ->with('mesaj', 'Kullanıcı Kaydınız Aktifleştirilmiştir.');
                } else {
                    return redirect('/')->with('mesaj_tur', 'warning')
                        ->with('mesaj', 'Kullanıcı Kaydınız Aktifleştirilemedi.Lütfen iletişime geçiniz.');
                }
            }
            else{
                return redirect('/')->with('mesaj','Kullanıcı aktivasyon kodunuzda sıkıntı var iletişime geçiniz.');
            }
        }
    public function oturumukapat(){

        auth()->logout();
        request()->session()->flush();
        request()->session()->regenerate();
        return redirect()->route('anasayfa');

    }
}
