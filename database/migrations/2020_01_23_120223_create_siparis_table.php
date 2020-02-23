<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiparisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siparis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sepet_id')->unsigned()->unique();
            $table->decimal('siparis_tutari',9,2);
            $table->string('durum',30);
            $table->string('adsoyad',200);
            $table->string('adres',600)->nullable();
            $table->string('telefon',20)->nullable();
            $table->string('ceptelefonu',15)->nullable();
            $table->string('banka',20)->nullable();
            $table->integer('taksit_sayisi')->nullable();
            $table->softDeletes()->nullable();
            $table->foreign('sepet_id')->references('id')->on('sepet')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siparis');
    }
}
