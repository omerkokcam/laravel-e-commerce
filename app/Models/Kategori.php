<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use SoftDeletes;
    protected $table='kategori';
    public $timestamps= true;
    protected $guarded=[];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';
    protected $fillable = ['kategori_adi','ust_id','slug'];


    public function urunler(){

        return $this->belongsToMany('App\Models\Urun','kategori_urun');
    }
    public function ust_kategori(){

        return $this->belongsTo('App\Models\Kategori','ust_id')->withDefault(['kategori_adi'=>'Ana Kategori ']);
    }
}
