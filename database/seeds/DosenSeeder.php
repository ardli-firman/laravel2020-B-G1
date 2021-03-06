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
    public function run(Faker\Generator $faker)
    {
        for ($i = 0; $i <= 99; $i++) {
            DB::table('dosen')->insert([
                'nama' => $faker->name,
                'email' => 'dosen' . $i . '@gmail.com',
                'password' => Hash::make('dosen'),
                'email_verified_at' => now(),
                'foto' => 'argon/img/theme/team-4-800x800.jpg',
                'file' => 'argon/img/theme/team-4-800x800.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
