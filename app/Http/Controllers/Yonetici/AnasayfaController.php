<?php

namespace App\Http\Controllers\Yonetici;

use App\Kullanici;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnasayfaController extends Controller
{
    public function index(){

        return view('yonetici.anasayfa');
    }
}
