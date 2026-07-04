# Aplikasi Manajemen Pemesanan Ruang Kelas

Aplikasi berbasis web untuk manajemen pemesanan ruang kelas oleh Dosen dan Mahasiswa, dengan sistem persetujuan (approval) oleh Admin. Dibangun menggunakan Laravel 11/12, Tailwind CSS (melalui Laravel Breeze), dan Spatie Permissions.

## Fitur Utama
- **Manajemen Akun & Role**: Terdapat 3 role utama (Admin, Dosen, Mahasiswa).
- **Manajemen Ruangan (Admin)**: Create, Read, Update, Delete data ruangan beserta fasilitas dan kapasitas.
- **Pemesanan Ruangan**: Dosen dan Mahasiswa dapat memesan ruangan yang aktif.
- **Validasi Waktu & Konflik**: 
  - Durasi pemesanan maksimal 8 jam.
  - Sistem otomatis mencegah "double-booking" (tidak bisa memesan jika sudah ada pemesanan berstatus `approved` pada jam yang bersinggungan).
- **Approval Flow**: Admin dapat menyetujui (`approve`) atau menolak (`reject` beserta alasan) pemesanan.
- **Pembatalan**: Pengguna dapat membatalkan pesanannya sendiri (selama belum lewat waktu).
- **Dashboard Interaktif**: Ringkasan jumlah antrian untuk admin, dan daftar pemesanan terdekat untuk pengguna.

## Kebutuhan Sistem
- PHP >= 8.3
- Composer
- Node.js & NPM
- SQLite (Default) / MySQL / PostgreSQL

## Instalasi

1. **Clone repository (jika dari remote) dan masuk ke direktori:**
   ```bash
   cd ruang-kelas
   ```

2. **Install dependensi PHP & Node.js:**
   ```bash
   composer install
   npm install
   npm run build
   ```

3. **Setup Environment:**
   Salin `.env.example` ke `.env` (jika belum ada).
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Migrasi Database & Seeding:**
   ```bash
   php artisan migrate:fresh --seed
   ```
   *Perintah ini akan membuat skema database dan mengisi data dummy.*

## Akun Demo

Seeder telah membuat 3 akun pengguna dengan role masing-masing:

| Role | Email | Password |
|---|---|---|
| **Admin** | admin@example.com | password |
| **Dosen** | dosen@example.com | password |
| **Mahasiswa** | mahasiswa@example.com | password |

## Menjalankan Aplikasi
Jalankan server pengembangan Laravel lokal:
```bash
php artisan serve
```
Buka `http://localhost:8000` di browser Anda.

## Konfigurasi Tambahan
Jika ingin mengubah batas maksimal durasi pemesanan (saat ini hardcoded 8 jam), Anda dapat menyesuaikan logic di `app/Http/Controllers/BookingController.php` method `store`.
Batas waktu pembatalan (saat ini 2 jam sebelum `start_at`) ada di method `cancel`.
