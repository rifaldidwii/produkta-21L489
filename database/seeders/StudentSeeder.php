<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        $students = User::where('role_id', 3)->get();

        $cities = ['Blitar', 'Tulungagung', 'Surabaya', 'Kediri', 'Trenggalek', 'Malang'];

        $schoolsGrades = [
            [
                ['SMPN 1 Sutojayan', 'SMPN 2 Sutojayan', 'SMPN 1 Kanigoro', 'SMPN 1 Wlingi'],
                ['7 SMP', '8 SMP', '9 SMP'],
            ],
            [
                ['SMAN 1 Sutojayan', 'SMAN 1 Kademangan', 'SMAN 1 Talun', 'SMAN 1 Garum'],
                ['10 SMA', '11 SMA', '12 SMA'],
            ],
        ];

        $jobs = ['Pedagang', 'Petani', 'PNS', 'Wiraswasta', 'Pegawai', 'Peternak', 'Tukang'];

        foreach ($students as $student) {
            $rand = rand(0, 1);

            DB::table('students')->insert([
                'user_id' => $student->id,
                'name' => ucwords(str_replace('.', ' ', $student->username)),
                'birthplace' => $faker->randomElement($cities),
                'birthdate' => $faker->dateTimeBetween('-19 years', '-13 years'),
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'school' => $schoolsGrades[$rand][0][rand(0, 1)],
                'grade' => $schoolsGrades[$rand][1][rand(0, 2)],
                'parent_name' => $faker->name,
                'parent_job' => $faker->randomElement($jobs),
                'parent_phone' => $faker->phoneNumber,
                'created_at' => now(),
            ]);
        }
    }
}
