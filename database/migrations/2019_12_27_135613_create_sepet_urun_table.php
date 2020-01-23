<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSepetUrunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sepet_urun', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sepet_id')->unsigned();
            $table->bigInteger('urun_id')->unsigned();
            $table->integer('adet')->unsigned();
            $table->decimal('tutar',5,2);
            $table->string('durum',30);
            $table->foreign('urun_id')->references('id')->on('urun')->onDelete('cascade');
            $table->foreign('sepet_id')->references('id')->on('sepet')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sepet_urun');
    }
}
