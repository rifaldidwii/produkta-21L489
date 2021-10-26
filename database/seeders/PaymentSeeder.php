<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = Student::all();

        foreach ($students as $student) {
            DB::table('payments')->insert([
                'student_id' => $student->id,
                'amount' => 250000,
                'description' => 'Biaya Pendaftaran Siswa Baru',
                'status' => 'Lunas',
                'created_at' => now()
            ]);

            DB::table('payments')->insert([
                'student_id' => $student->id,
                'amount' => rand(500000, 900000),
                'description' => 'Pembayaran Semester Genap 2020/2021',
                'status' => 'Belum Dibayar',
                'created_at' => now()
            ]);

            DB::table('payments')->insert([
                'student_id' => $student->id,
                'amount' => rand(100000, 200000),
                'description' => 'Pembayaran Tambahan',
                'status' => 'Belum Dibayar',
                'created_at' => now()
            ]);
        }
    }
}
