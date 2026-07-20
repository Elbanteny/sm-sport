# SM Sport Center - Booking System 🏟️

Sistem informasi dan reservasi lapangan olahraga berbasis web yang modern, interaktif, dan futuristik. Aplikasi ini dirancang untuk memudahkan pengguna dalam mengecek ketersediaan lapangan secara _real-time_ dan melakukan reservasi langsung.

## 🚀 Teknologi Utama

- **Backend & Framework:** Laravel 13 (PHP 8.3+)
- **Frontend Styling:** Tailwind CSS v4 (Menggunakan arsitektur berbasis Vite + CSS-first configuration)
- **Database:** MySQL / MariaDB
- **Containerization:** Docker & Docker Compose

---

## 🛠️ Cara Menjalankan Secara Lokal (Tanpa Docker)

Jika Anda ingin menjalankan aplikasi ini langsung di mesin lokal Anda, ikuti langkah-langkah berikut:

### 1. Kloning Repositori

```bash
git clone [https://github.com/username/sm-sport-center.git](https://github.com/username/sm-sport-center.git)
cd sm-sport-center
```

### 2. Instalasi Dependensi Backend

```bash

composer install

```

### 3. Instalasi & Kompilasi Aset Frontend (Tailwind v4)

Catatan: Tailwind v4 tidak lagi membutuhkan file tailwind.config.js. Konfigurasi tema langsung disuntikkan di dalam resources/css/app.css.

```bash
npm install
```

### 4. Konfigurasi Environment

Salin file .env.example menjadi .env dan sesuaikan kredensial database Anda:

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Migrasi & Seed Database

```bash
php artisan migrate --seed
```

### 6. Jalankan project

```bash
composer run dev
```

## 🐳 Cara Menjalankan Menggunakan Docker

Untuk mempermudah proses deployment tanpa perlu menginstal PHP atau Node.js secara lokal, Anda bisa menggunakan Docker Compose yang sudah dikonfigurasi.

### 1. Persiapan

Pastikan Docker dan Docker Compose sudah terinstal di komputer Anda. Cukup salin file .env:

```bash
cp .env.example .env
```

(Pastikan DB_HOST di dalam .env diarahkan ke nama service database Docker, yaitu db)

### 2. Build dan Jalankan Kontainer

Eksekusi perintah berikut untuk menyalakan semua service (Web server, PHP, MySQL, dan Node Vite):

```bash
docker compose up -d --build
```

### 3. Jalankan Perintah Setup di Dalam Kontainer

```bash
# Instal dependensi PHP
docker compose exec app composer install

# Generate Key Aplikasi
docker compose exec app php artisan key:generate

# Jalankan Migrasi dan Seeder Database
docker compose exec app php artisan migrate --seed

# Instal & Kompilasi Aset Tailwind v4
docker compose exec app npm install
docker compose exec app text: npm run build
```

Akses aplikasi Anda melalui URL: http://localhost:8080

## 📂 Struktur Perintah Otomatisasi (Opsional)

Aplikasi ini mendukung pengecekan status otomatis untuk mengubah lapangan menjadi "Sedang Disewa" atau "Tersedia" berdasarkan jam pemesanan nyata.

Untuk mengaktifkannya di latar belakang (Production), nyalakan task scheduler:

```bash
php artisan schedule:work
```
