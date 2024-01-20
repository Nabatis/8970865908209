<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $booksData = [
            [
                'judul' => 'Judul Buku Pertama',
                'penulis' => 'Penulis A',
                'penerbit' => 'Penerbit X',
                'tahun_terbit' => 2020,
                'deskripsi' => 'APA SAJA YANG PENTING ADA',
            ],
            [
                'judul' => 'Judul Buku Kedua',
                'penulis' => 'Penulis B',
                'penerbit' => 'Penerbit Y',
                'tahun_terbit' => 2021,
                'deskripsi' => 'APA SAJA YANG PENTING ADA',
            ],
            [
                'judul' => 'Judul Buku Ketiga',
                'penulis' => 'Penulis C',
                'penerbit' => 'Penerbit W',
                'tahun_terbit' => 2021,
                'deskripsi' => 'APA SAJA YANG PENTING ADA',
            ],
            [
                'judul' => 'Judul Buku Keempat',
                'penulis' => 'Penulis D',
                'penerbit' => 'Penerbit G',
                'tahun_terbit' => 2021,
                'deskripsi' => 'APA SAJA YANG PENTING ADA',
            ],
        ];
        foreach ($booksData as $book) {
            Buku::create($book);
        }
    }
}
