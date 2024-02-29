<?php

namespace Database\Seeders;

use App\Models\Durasipinjam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Durasihari extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $durasiData = [
            [
                'durasi_hari' => '2'
            ],
            [
                'durasi_hari' => '4'
            ],
        ];
        foreach ($durasiData as $durasi) {
            Durasipinjam::create($durasi);
        }
    }
}
