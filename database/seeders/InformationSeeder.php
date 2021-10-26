<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('information')->insert([
            'name' => 'Deskripsi',
            'description' => 'Lembaga Kursus dan Pelatihan Ar Risalah adalah lembaga pendidikan non formal
            yang membantu siswa untuk belajar pada jenjang TK, SD, SMP, dan SMA.',
            'created_at' => now()
        ]);
        DB::table('information')->insert([
            'name' => 'Tentang Kami',
            'description' => 'Ar Risalah mulai dirintis pada bulan Desember 2010 dengan pembukaan kelas pertama di    Jl. Mawar No.10 RT. 02 RW. 01 Kel. Kalipang Kec. Sutojayan Kab. Blitar.<br>
            Dengan meningkatnya animo masyarakat terhadap pendidikan maka terbentuklah Ar Risalah sebagai wadah terbentuknya lembaga pendidikan yang berkualitas.',
            'created_at' => now()
        ]);
        DB::table('information')->insert([
            'name' => 'Visi',
            'description' => 'Menjadi lembaga pendidikan non formal yang terbaik dan berkualitas untuk
            generasi unggul penerus bangsa Indonesia',
            'created_at' => now()
        ]);
        DB::table('information')->insert([
            'name' => 'Misi',
            'description' => 'a. Melaksanakan amanah Pancasila dan UUD 1945<br>
            b. Ikut berperan aktif dalam mencerdaskan bangsa<br>
            c. Meningkatkan mutu pendidikan nasional dengan memberikan pemahaman belajar secara utuh<br>
            d. Membuka lapangan pekerjaan kepada seluruh masyarakat Indonesia pada umumnya dan
            masyarakat Blitar pada khususnya',
            'created_at' => now()
        ]);
        DB::table('information')->insert([
            'name' => 'Foto',
            'description' => 'https://res.cloudinary.com/lkp-ar-risalah/image/upload/v1619673563/1_g4ms00.jpg',
            'created_at' => now()
        ]);
        DB::table('information')->insert([
            'name' => 'Foto',
            'description' => 'https://res.cloudinary.com/lkp-ar-risalah/image/upload/v1619673567/2_zhlvca.jpg',
            'created_at' => now()
        ]);
        DB::table('information')->insert([
            'name' => 'Foto',
            'description' => 'https://res.cloudinary.com/lkp-ar-risalah/image/upload/v1619673560/3_jmc3ra.jpg',
            'created_at' => now()
        ]);
        DB::table('information')->insert([
            'name' => 'Fasilitas',
            'description' => 'Kursus Bahasa Inggris',
            'created_at' => now()
        ]);
        DB::table('information')->insert([
            'name' => 'Fasilitas',
            'description' => 'Pelatihan Batik dan Tata Boga',
            'created_at' => now()
        ]);
        DB::table('information')->insert([
            'name' => 'Fasilitas',
            'description' => 'Mengaji Al-Quran dan Fiqih',
            'created_at' => now()
        ]);
        DB::table('information')->insert([
            'name' => 'Testimoni',
            'description' => '<p class="mt-2">"Belajar di LKP Ar Risalah sangat menyenangkan"</p><span class="h6">- Adinata</span>',
            'created_at' => now()
        ]);
        DB::table('information')->insert([
            'name' => 'Testimoni',
            'description' => '<p class="mt-2">"Kegiatan Belajar Mengajar sama seperti di sekolah"</p><span class="h6">- Dewi</span>',
            'created_at' => now()
        ]);
        DB::table('information')->insert([
            'name' => 'Testimoni',
            'description' => '<p class="mt-2">"Guru sangat membantu dalam menjelaskan materi"</p><span class="h6">- Diana</span>',
            'created_at' => now()
        ]);
        DB::table('information')->insert([
            'name' => 'Testimoni',
            'description' => '<p class="mt-2">"Biaya bimbingan belajar terjangkau"</p><span class="h6">- Anis</span>',
            'created_at' => now()
        ]);
    }
}
