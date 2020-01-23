<?php

use App\Models\KategoriUrun;
use Illuminate\Database\Seeder;


class kategori_urunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 30; $i++){
            KategoriUrun::insert
            ([

                'urun_id' => rand(1, 31),
                'kategori_id' => rand(1, 14),

            ]);
    }
    }
}

