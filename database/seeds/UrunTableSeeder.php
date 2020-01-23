<?php

use App\Models\Urun;
use Illuminate\Database\Seeder;
use App\Models\UrunDetay;


class UrunTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)//burada faker kutuphanesini kullanıyoruz
    {

        for($i=0;$i<=30;$i++)
        {
            //faker kutuphanesini kulllanalım.
            $urun_adi=$faker->sentence(2);

            $urun = Urun::create(['urun_adi'=>$urun_adi,
                'slug'=>Str::slug($urun_adi),
                'aciklama'=>$faker->paragraph(20),
                'fiyati'=>$faker->randomFloat(3,1,20)

            ]);
            $detay = $urun->detay()->create([

                'goster_slider'=>rand(0,1),
                'goster_gunun_firsati'=>rand(0,1),
                'goster_one_cikan'=>rand(0,1),
                'goster_cok_satan'=>rand(0,1),
                'goster_indirimli'=>rand(0,1),


            ]);

        }
    }
}
