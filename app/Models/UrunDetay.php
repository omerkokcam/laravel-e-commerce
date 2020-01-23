<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UrunDetay extends Model
{
    protected $table = 'urun_detay';

    public $timestamps=false;


    public function urun(){
        //urundetay icerisinde urune ait bilgilere ulaşmak isterse
        return $this->belongsTo('App\Models\Urun');
    }
}
