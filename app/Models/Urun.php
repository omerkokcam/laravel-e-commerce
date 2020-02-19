<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Urun extends Model
{
    use SoftDeletes;
    protected $table='urun';
    public $timestamps= true;
    protected $guarded=[];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';
    protected $fillable = ['urun_adi','slug','aciklama','fiyati'];
    public function kategoriler(){

        return $this->belongsToMany('App\Models\Kategori','kategori_urun');
    }
    public function detay(){
        //urun modelinin içerisinde urune ait olan detay bilgisini cekme
        return $this->hasOne('App\Models\UrunDetay')->withDefault();
    }


}
