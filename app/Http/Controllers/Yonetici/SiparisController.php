<?php

namespace App\Http\Controllers\Yonetici;

use App\Models\Siparis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiparisController extends Controller
{
    public function index(){

        if(\request()->filled('aranan')){
            request()->flash();
            $aranan = \request('aranan');
            $list = Siparis::where('adsoyad','like','%$aranan%')->orWhere('banka','like','%$aranan%')->orderByDesc('id')->paginate(8)->appends('aranan',$aranan);

        }
        else{
            $list = Siparis::orderByDesc('id')->paginate(8);
        }
        return view('yonetici.siparis.index',compact('list'));
    }

    public function form($id = 0){
        if($id > 0 ){
            //guncelleme yap
        }
        else{
            //yeni kayit olustur
        }
    }

    public function kayit($id = 0){

    }

    public function sil($id){

    }
}
