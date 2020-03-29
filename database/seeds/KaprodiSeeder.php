<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KaprodiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kaprodi')->insert([
            'nama' => 'Kaprodi 1',
            'email' => 'kaprodi@gmail.com',
            'password' => Hash::make('kaprodi'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
