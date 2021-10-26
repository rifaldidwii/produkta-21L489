<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        DB::table('users')->insert([
            [
                'username' => 'admin',
                'role_id' => 1,
                'email' => 'lkparrisalah@gmail.com',
                'password' => '$2y$10$WwxzwV4tJHTavq.Mjh2Qfuc.hL/lSrf3SyWUG.kIyFuf.C4Fh5Ov.', // suksesmulia
                'remember_token' => Str::random(10),
                'profile_photo' => 'https://ui-avatars.com/api/?name=ar&size=512',
                'email_verified_at' => now(),
                'created_at' => now(),
            ]
        ]);

        $domain = ['gmail.com', 'yahoo.com', 'outlook.com', 'icloud.com'];

        for ($i = 0; $i < 5; $i++) {
            $name = strtolower(explode(' ', $faker->name())[0]) . '.' . strtolower(explode(' ', $faker->name())[1]);

            DB::table('users')->insert([
                [
                    'username' => $name,
                    'role_id' => 2,
                    'email' => $name . '@' . $faker->randomElement($domain),
                    'password' => '$2y$10$UZGaNDR0DDOdnaKCk4F6X.3aTqPJ7uJ3elCRfJluoF6JwTfdlqtpK', // sehatmulia
                    'remember_token' => Str::random(10),
                    'profile_photo' => 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&size=512',
                    'email_verified_at' => now(),
                    'created_at' => now(),
                ]
            ]);
        }

        for ($i = 0; $i < 45; $i++) {
            $name = strtolower(explode(' ', $faker->name)[0]) . '.' . strtolower(explode(' ', $faker->name)[1]);

            DB::table('users')->insert([
                [
                    'username' => $name,
                    'role_id' => 3,
                    'email' => strtolower(str_replace(" ", ".", $name)) . '@' . $faker->randomElement($domain),
                    'password' => '$2y$10$LTddShBOCHLpcvFY00/rxOHX2b0yZavOUhiBsE3EIK.0jep2ZyhBq', // sehatmulia
                    'remember_token' => Str::random(10),
                    'profile_photo' => 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&size=512',
                    'email_verified_at' => now(),
                    'created_at' => now(),
                ]
            ]);
        }
    }
}
