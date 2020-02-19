<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KullaniciDetay extends Model
{
    protected $table = 'kullanici_detay';
    protected $timestamps = false;
    protected $guarded = [];
    protected $fillable = ['kullanici_id','adsoyad','adres','telefon','ceptelefonu'];

    public function kullanici(){

        return $this->belongsTo('App\Models\Kullanici');
    }
}
