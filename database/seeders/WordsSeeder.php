<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WordsSeeder extends Seeder
{
    /**
     * Seed the words table for Undercover game.
     */
    public function run(): void
    {
        $wordPairs = [
            ['kata1' => 'APEL', 'kata2' => 'JERUK'],
            ['kata1' => 'KUCING', 'kata2' => 'ANJING'],
            ['kata1' => 'MOBIL', 'kata2' => 'MOTOR'],
            ['kata1' => 'BUKU', 'kata2' => 'MAJALAH'],
            ['kata1' => 'KOPI', 'kata2' => 'TEH'],
            ['kata1' => 'NASI', 'kata2' => 'ROTI'],
            ['kata1' => 'PENSIL', 'kata2' => 'PULPEN'],
            ['kata1' => 'LAUT', 'kata2' => 'SUNGAI'],
            ['kata1' => 'GUNUNG', 'kata2' => 'BUKIT'],
            ['kata1' => 'RUMAH', 'kata2' => 'APARTEMEN'],
            ['kata1' => 'PANTAI', 'kata2' => 'KOLAM'],
            ['kata1' => 'DOKTER', 'kata2' => 'PERAWAT'],
            ['kata1' => 'GURU', 'kata2' => 'DOSEN'],
            ['kata1' => 'POLISI', 'kata2' => 'TENTARA'],
            ['kata1' => 'KAMERA', 'kata2' => 'HANDPHONE'],
            ['kata1' => 'KOMPUTER', 'kata2' => 'LAPTOP'],
            ['kata1' => 'PESAWAT', 'kata2' => 'HELIKOPTER'],
            ['kata1' => 'KERETA', 'kata2' => 'BUS'],
            ['kata1' => 'SENDOK', 'kata2' => 'GARPU'],
            ['kata1' => 'PIRING', 'kata2' => 'MANGKUK'],
            ['kata1' => 'BAJU', 'kata2' => 'JAKET'],
            ['kata1' => 'SEPATU', 'kata2' => 'SANDAL'],
            ['kata1' => 'HUJAN', 'kata2' => 'GERIMIS'],
            ['kata1' => 'PETIR', 'kata2' => 'GURUH'],
            ['kata1' => 'BULAN', 'kata2' => 'MATAHARI'],
            ['kata1' => 'SIANG', 'kata2' => 'MALAM'],
            ['kata1' => 'KEJU', 'kata2' => 'MENTEGA'],
            ['kata1' => 'SUSU', 'kata2' => 'YOGURT'],
            ['kata1' => 'KUE', 'kata2' => 'BISKUIT'],
            ['kata1' => 'AYAM', 'kata2' => 'BEBEK'],
        ];

        $now = now();
        $rows = array_map(static function (array $pair) use ($now): array {
            return [
                'kata1' => $pair['kata1'],
                'kata2' => $pair['kata2'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, $wordPairs);

        DB::table('words')->truncate();
        DB::table('words')->insert($rows);
    }
}
