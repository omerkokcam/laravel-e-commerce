<?php

namespace App\Http\Controllers;

use App\Kullanici;
use App\Mail\KullaniciKayitMail;
use App\Models\Sepet;
use App\Models\SepetUrun;
use Gloudemans\Shoppingcart\Facades\Cart;
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
        $credentials=[
            'email'=>request('email'),
            'password'=>request('sifre'),
            'aktif_mi'=>1
        ];


        if(auth()->attempt($credentials,request()->has('benihatirla')) ){

            request()->session()->regenerate();
            $sepet = new Sepet();
            $aktif_sepet_id = $sepet->aktif_sepet_id();

            if(is_null($aktif_sepet_id)){
                $aktif_sepet_id = Sepet::create(['kullanici_id'=>auth()->id()]);
                $aktif_sepet_id = $aktif_sepet_id->id;

            }

            session()->put('aktif_sepet_id',$aktif_sepet_id);

            if(Cart::count() > 0){
                foreach (Cart::content() as $cartItem){
                    SepetUrun::updateOrCreate(
                        ['sepet_id'=> $aktif_sepet_id, 'urun_id'=>$cartItem->id],
                        ['adet'=>$cartItem->qty, 'fiyati'=>$cartItem->price, 'durum'=>'Beklemede']);
                }

            }
            return redirect()->intended('/');
        }
        else{

            $errors = ['email' => 'Hatalı Giriş.','sent'=>'Emailden hesap aktifliğini onaylamayı unutmayın!'];
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
