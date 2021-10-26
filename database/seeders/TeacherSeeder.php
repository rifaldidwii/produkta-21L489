<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        $teachers = User::where('role_id', 2)->get();

        $cities = ['Blitar', 'Tulungagung', 'Surabaya', 'Kediri', 'Trenggalek', 'Malang'];

        $field = [
            'Matematika',
            'Fisika',
            'Biologi',
            'Kimia',
            'B. Inggris',
        ];

        $i = 0;
        foreach ($teachers as $teacher) {
            DB::table('teachers')->insert([
                'user_id' => $teacher->id,
                'name' => ucwords(str_replace('.', ' ', $teacher->username)),
                'birthplace' => $faker->randomElement($cities),
                'birthdate' => $faker->dateTimeBetween('-35 years', '-25 years'),
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'field' => $field[$i],
                'created_at' => now(),
            ]);
            $i++;
        }
    }
}
