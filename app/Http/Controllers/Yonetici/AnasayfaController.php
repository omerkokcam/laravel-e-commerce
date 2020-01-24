<?php

namespace App\Http\Controllers\Yonetici;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnasayfaController extends Controller
{
    public function index(){

        return view('yonetici.anasayfa');
    }
}
