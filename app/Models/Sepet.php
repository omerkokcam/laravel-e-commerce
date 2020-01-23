<?php

namespace App\Models;

use App\Kullanici;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sepet extends Model
{
    use SoftDeletes;
    protected $table='sepet';
    protected $fillable = ['kullanici_id'];
    protected $guarded = [];

//    public function Kullanici() {
//        return $this->belongsTo(Kullanici::class, 'kullanici_id');
//    }
    public function siparis(){

        return $this->hasOne('App\Models\Siparis');
    }

}
