<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PertanyaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            "Seberapa sering Anda merasa cemas atau gelisah akhir-akhir ini?",
            "Seberapa sering Anda merasa kehilangan minat atau kesenangan dalam melakukan aktivitas?",
            "Seberapa sering Anda merasa kesulitan untuk tidur atau tetap tidur?",
            "Seberapa sering Anda merasa lelah atau memiliki energi yang rendah?",
            "Seberapa sering Anda merasa kesulitan untuk berkonsentrasi pada sesuatu?",
            "Seberapa sering Anda merasa buruk tentang diri sendiri atau merasa gagal?",
            "Seberapa sering Anda merasa gelisah sehingga sulit untuk duduk diam?",
            "Seberapa sering Anda merasa takut seolah-olah sesuatu yang buruk akan terjadi?",
            "Seberapa sering Anda merasa putus asa tentang masa depan?",
            "Seberapa sering Anda merasa sulit untuk bersantai?"
        ];

        foreach ($questions as $q) {
            \App\Models\Pertanyaan::create(['pertanyaan' => $q]);
        }
    }
}
