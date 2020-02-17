<?php

namespace App\Http\Controllers\Yonetici;

use App\Kullanici;
use App\Models\KullaniciDetay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

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
    public function oturumukapat(){
        auth()->logout();
        request()->session()->flush();
        request()->session()->regenerate();

        return redirect()->route('anasayfa');
    }
    public function index(){
        $liste=Kullanici::orderBy('created_at','desc')->paginate(8);
        return view('yonetici.kullanici.index',compact('liste'));
    }
    public function form($id = 0){

       $entry = new Kullanici();
        if($id>0){
            $entry = Kullanici::find($id);

        }
        return view('yonetici.kullanici.form',compact('entry'));



    }

    public function kayit(Request $request, $id = 0){
        $this->validate(\request(),[
            'adsoyad' => 'required',
            'email' => 'required|email'
        ]);
        $data = \request()->only('adsoyad','email');
        if(\request()->filled('sifre')){
            $data['sifre'] = Hash::make(\request('sifre'));

        }


        if($id > 0 ){
            //guncelle

            $entry = Kullanici::find($id);
            $entry->update([
                'adsoyad'=> request('adsoyad'),
                'email'=> request('email'),
                'sifre'=> Hash::make( request('sifre')),

                'aktif_mi'=> request()->has('aktif_mi')?1:0,
                'yonetici_mi' =>request()->has('yonetici_mi')?1:0

                ]);


        }
        else{
            //yeni kayıt

            $entry = Kullanici::create([

                'adsoyad'=> request('adsoyad'),
                'email'=> request('email'),
                'sifre'=> Hash::make( request('sifre')),
                'aktif_mi'=> request()->has('aktif_mi')?1:0,
                'yonetici_mi' =>request()->has('yonetici_mi')?1:0

            ]);
        }

        return redirect()->route('yonetici.kullanici');
    }


    public function sil($id){
        Kullanici::find($id)->forceDelete();
        return redirect()->route('anasayfa')->with('mesaj','Kayıt Silindi')->with('mesaj_tur','success');

    }

}
