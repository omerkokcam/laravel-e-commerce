<?php

namespace App\Http\Controllers\Yonetici;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    public function index(){
        if (request()->filled('aranan')){
            \request()->flash();
            $aranan  = \request('aranan');
            $list = Kategori::where('kategori_adi','like','%aranan%')
                    ->orderByDesc('created_at')
                    ->paginate(8)
                    ->appends('aranan',$aranan);
        }
        else{

            $list = Kategori::orderByDesc('created_at')->paginate(8);
        }
        return view('yonetici.kategori.index',compact('list'));
    }
    public function form($id = 0){

        $entry = new Kategori();
        if($id>0){
            $entry=Kategori::find($id);

        }
        return view('yonetici.kategori.form',compact('entry'));


    }

    public function kaydet($id = 0)
    {

    }

    public function sil(){

    }
}
