<?php

namespace App\Http\Controllers\Yonetici;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KullaniciController extends Controller
{
    public function oturumac(){

        return view('yonetici.oturumac');
    }
}
