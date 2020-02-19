<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SepetUrun extends Model
{
    use softdeletes;
    protected $table = 'sepet_urun';
    protected $guarded = [];
    protected $fillable = ['sepet_id','urun_id','adet','tutar','durum'];


}
