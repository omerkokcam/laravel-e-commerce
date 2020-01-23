<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siparis extends Model
{
    use SoftDeletes;
    protected $table = 'siparis';
    protected $fillable = ['sepet_id','siparis_tutari','banka','taksit_sayisi','durum'];
    //guarded kullanırsak tablodaki tüm elemanları ekleyebileceğimizi anlatıyorduk $protected = guarded[];

    public function sepet(){
        //direkt olarak siparis modelinden sepet modeline ulasabilmeyi hedefliyoruz.
        return $this->belongsTo('App\Models\Sepet');

    }
}
