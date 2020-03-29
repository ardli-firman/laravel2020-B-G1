<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mahasiswa')->insert([
            'nim' => '17090081',
            'nama' => 'Ardli FM',
            'semester' => '6',
            'kelas' => 'B',
            'tahun' => '2017',
            'password' => Hash::make('f'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
