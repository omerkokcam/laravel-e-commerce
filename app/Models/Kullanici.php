<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Kullanici extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'kullanici';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    protected $fillable = [
        'adsoyad', 'email', 'sifre','aktivasyon_anahtari','aktif_mi','yonetici_mi'
    ];


    protected $hidden = [
        'sifre', 'aktivasyon_anahtari',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //controllerdaki request('sifre') alanını database de de sifre diye kontrol edebilmesi için kullandık.
    //override ettik password yerine sifre kullanılacak diyoruz
    public function getAuthPassword()
    {

        return $this->sifre;
    }

    public function kullanici_detay(){

        return $this->hasOne('App\Models\KullaniciDetay');
    }
}
