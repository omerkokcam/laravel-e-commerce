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
            $table->decimal('siparis_tutari',5,4);
            $table->string('durum',30);
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
