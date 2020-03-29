<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dosen')->insert([
            'nama' => 'Dosen 1',
            'email' => 'dosen@gmail.com',
            'password' => Hash::make('dosen'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
