<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UrunDetay extends Model
{
    protected $table = 'urun_detay';
    protected $guarded = [];
    protected $fillable=['urun_id','goster_slider','goster_gunun_firsati','goster_one_cikan','goster_cok_satan','goster_indirimli','urun_resmi'];
    public $timestamps=false;


    public function urun(){
        //urundetay icerisinde urune ait bilgilere ulaşmak isterse
        return $this->belongsTo('App\Models\Urun');
    }
}
