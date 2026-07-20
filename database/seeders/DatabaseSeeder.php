<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Lapangan;
use App\Models\Reservasi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // --- 1. SEEDING USERS ---
        $admin = User::create([
            'name' => 'Admin SM Sport',
            'email' => 'admin@smsport.com',
            'password' => Hash::make('password123'),
            'phone' => '08123456789',
            'role' => 'admin',
        ]);

        $customer = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password123'),
            'phone' => '08987654321',
            'role' => 'customer',
        ]);

        // --- 2. SEEDING 7 LAPANGAN (Nilai 'tipe' & 'facilities' Sudah Disesuaikan dengan DB) ---
        $lap1 = Lapangan::create([
            'nama_lapangan' => 'Lapangan Futsal Vinyl Premium',
            'jenis_lapangan' => 'futsal',
            'kategori' => 'Futsal',
            'tipe' => 'indoor', // Menggunakan huruf kecil sesuai ENUM DB
            'image_url' => 'https://images.unsplash.com/photo-1763775594018-4a84eeadd83d?w=500&auto=format&fit=crop&q=80&w=800',
            'tarif_per_jam' => 150000,
            'rating' => 5.0,
            'reviews' => 48,
            'badge' => 'Interlock Premium',
            'deskripsi' => 'Lapangan futsal indoor berskala standar nasional. Memakai lantai vinyl berkualitas tinggi setebal 8mm yang empuk dan aman untuk sendi lutut, dilengkapi pencahayaan LED profesional anti silau.',
            'facilities' => json_encode(['Shower Room', 'Ruang Ganti', 'Free Parking', 'Scoreboard Digital']) // Encode ke JSON
        ]);

        $lap2 = Lapangan::create([
            'nama_lapangan' => 'Lapangan Futsal Rumput Sintetis',
            'jenis_lapangan' => 'futsal',
            'kategori' => 'Futsal',
            'tipe' => 'indoor', // Menggunakan huruf kecil sesuai ENUM DB
            'image_url' => 'https://images.unsplash.com/photo-1568194157720-8bbe7114ebe8?auto=format&fit=crop&q=80&w=800',
            'tarif_per_jam' => 120000,
            'rating' => 4.8,
            'reviews' => 32,
            'badge' => 'Rumput Monofilament',
            'deskripsi' => 'Sensasi bermain futsal outdoor semi-indoor dengan rumput sintetis jenis Monofilament yang lembut, meminimalisir luka lecet saat sliding.',
            'facilities' => json_encode(['Ruang Ganti', 'Free Parking', 'Kantin'])
        ]);

        $lap3 = Lapangan::create([
            'nama_lapangan' => 'Lapangan Badminton A (Yonex Mat)',
            'jenis_lapangan' => 'badminton',
            'kategori' => 'Badminton',
            'tipe' => 'indoor', // Menggunakan huruf kecil sesuai ENUM DB
            'image_url' => 'https://images.unsplash.com/photo-1626224583764-f87db24ac4ea?auto=format&fit=crop&q=80&w=800',
            'tarif_per_jam' => 70000,
            'rating' => 4.9,
            'reviews' => 60,
            'badge' => 'Karpet Yonex Supreme',
            'deskripsi' => 'Lapangan bulutangkis premium menggunakan karpet karet standar BWF merek Yonex. Grip sangat mantap dan tidak licin.',
            'facilities' => json_encode(['Shower Room', 'Tempat Duduk Penonton', 'Water Station'])
        ]);

        $lap4 = Lapangan::create([
            'nama_lapangan' => 'Lapangan Badminton B (Yonex Mat)',
            'jenis_lapangan' => 'badminton',
            'kategori' => 'Badminton',
            'tipe' => 'indoor', // Menggunakan huruf kecil sesuai ENUM DB
            'image_url' => 'https://plus.unsplash.com/premium_photo-1708119178805-321dec8ba9cf?w=500&auto=format&fit=crop&q=80&w=800',
            'tarif_per_jam' => 70000,
            'rating' => 4.7,
            'reviews' => 19,
            'badge' => 'Karpet Yonex Supreme',
            'deskripsi' => 'Spesifikasi serupa dengan Lapangan A. Ideal untuk turnamen lokal maupun sparing rutin komunitas Anda.',
            'facilities' => json_encode(['Tempat Duduk Penonton', 'Free Parking'])
        ]);

        $lap5 = Lapangan::create([
            'nama_lapangan' => 'Lapangan Basket Vinyl Wood',
            'jenis_lapangan' => 'basket',
            'kategori' => 'Basket',
            'tipe' => 'indoor', // Menggunakan huruf kecil sesuai ENUM DB
            'image_url' => 'https://images.unsplash.com/photo-1544698310-74ea9d1c8258?auto=format&fit=crop&q=80&w=800',
            'tarif_per_jam' => 175000,
            'rating' => 5.0,
            'reviews' => 25,
            'badge' => 'Wooden Vinyl Concept',
            'deskripsi' => 'Lapangan basket indoor dengan lapisan lantai vinyl motif kayu standar liga profesional. Pantulan bola sempurna dan ring basket hidrolik.',
            'facilities' => json_encode(['Ruang Ganti', 'Scoreboard Digital', 'Shower Room', 'Tribun'])
        ]);

        $lap6 = Lapangan::create([
            'nama_lapangan' => 'Lapangan Badminton C (Standard Court)',
            'jenis_lapangan' => 'badminton',
            'kategori' => 'Badminton',
            'tipe' => 'outdoor', // Menggunakan huruf kecil sesuai ENUM DB
            'image_url' => 'https://plus.unsplash.com/premium_photo-1663039984787-b11d7240f592?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8bGFwYW5nYW4lMjBiYWRtaW50b258ZW58MHx8MHx8fDA%3D',
            'tarif_per_jam' => 65000,
            'rating' => 4.4,
            'reviews' => 22,
            'badge' => 'Lantai Semen Polished',
            'deskripsi' => 'Lapangan bulutangkis ekonomis dengan lantai semen halus yang dicat standar. Cocok untuk latihan santai.',
            'facilities' => json_encode(['Kantin', 'Free Parking', 'Shower Room'])
        ]);

        $lap7 = Lapangan::create([
            'nama_lapangan' => 'Lapangan Futsal Outdoor Standard',
            'jenis_lapangan' => 'futsal',
            'kategori' => 'Futsal',
            'tipe' => 'outdoor', // Menggunakan huruf kecil sesuai ENUM DB
            'image_url' => 'https://images.unsplash.com/photo-1518063319789-7217e6706b04?auto=format&fit=crop&q=80&w=800',
            'tarif_per_jam' => 90000,
            'rating' => 4.5,
            'reviews' => 22,
            'badge' => 'Lantai Semen Lapisi Karet',
            'deskripsi' => 'Lapangan futsal luar ruangan berpaving semen berlapis cat karet. Rasakan udara segar saat bermain di sore atau malam hari.',
            'facilities' => json_encode(['Lampu Sorot Malam', 'Free Parking'])
        ]);

        // --- 3. SEEDING BOOKING AKTIF HARI INI ---
        $sekarang = Carbon::now('Asia/Jakarta');
        
        // Mulai 30 menit lalu dan berakhir 1 jam kemudian agar statusnya "Sedang Disewa" saat dicek saat ini
        $jamMulai = $sekarang->copy()->subMinutes(30)->format('H:i:s'); 
        $jamSelesai = $sekarang->copy()->addHours(1)->format('H:i:s'); 

        // Lapangan 1 (Futsal Vinyl) dibooking aktif
        Reservasi::create([
            'user_id' => $customer->id,
            'lapangan_id' => $lap1->id,
            'tanggal' => $sekarang->toDateString(),
            'jam_mulai' => $jamMulai,
            'jam_selesai' => $jamSelesai,
            'total_harga' => 300000,
            'status' => 'disetujui'
        ]);

        // Lapangan 5 (Basket Vinyl) dibooking aktif
        Reservasi::create([
            'user_id' => $customer->id,
            'lapangan_id' => $lap5->id,
            'tanggal' => $sekarang->toDateString(),
            'jam_mulai' => $jamMulai,
            'jam_selesai' => $jamSelesai,
            'total_harga' => 350000,
            'status' => 'disetujui'
        ]);
    }
}