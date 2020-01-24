<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKullaniciTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kullanici', function (Blueprint $table) {
            $table -> bigIncrements('id');
            $table -> string('adsoyad',70);
            $table -> string('email',200) -> unique();
            $table -> string('sifre',60);
            $table -> string('aktivasyon_anahtari',60 )->nullable();
            $table -> boolean('aktif_mi') ->default(0) ;
            $table -> boolean('yonetici_mi') ->default(0) ;
            $table -> softDeletes()->nullable();
            $table -> timestamps();

            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kullanici');
    }
}
