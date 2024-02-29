<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriData = [
            [
                'name' => 'Biografi'
            ],
            [
                'name' => 'Dongeng'
            ],
            [
                'name' => 'Ensiklopedia'
            ],
            [
                'name' => 'Komik'
            ],
            [
                'name' => 'Novel'
            ],
            [
                'name' => 'Pelajaran Umum'
            ],
            [
                'name' => 'Sains'
            ],

        ];
        foreach ($kategoriData as $kategori) {
            Kategori::create($kategori);
        }
    }
}
