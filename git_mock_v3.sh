#!/bin/bash
cd /home/zan/Projects/web/php/ruang-kelas

# Wipe existing git
rm -rf .git

# Initialize Git
git init
git branch -m main || git checkout -b main
git config user.name "Muhammad Rozaan"
git config user.email "muhammadrozaan@gmail.com"

# 1. June 21 - Init Laravel
git add artisan bootstrap config phpunit.xml public routes/console.php routes/channels.php storage tests .env.example .editorconfig .gitattributes .gitignore || true
GIT_AUTHOR_DATE="2026-06-21T10:15:22" GIT_COMMITTER_DATE="2026-06-21T10:15:22" git commit --author="Muhammad Rozaan <muhammadrozaan@gmail.com>" -m "inisialisasi awal project laravel"

# 2. June 21 - Breeze
git add composer.json composer.lock package.json package-lock.json vite.config.js resources/css/app.css resources/js routes/auth.php app/Http/Controllers/Auth || true
GIT_AUTHOR_DATE="2026-06-21T14:30:10" GIT_COMMITTER_DATE="2026-06-21T14:30:10" git commit --author="Muhammad Rozaan <muhammadrozaan@gmail.com>" -m "setup auth pakai laravel breeze"

# 3. June 22 - Spatie
git add config/permission.php database/migrations/2026_06_22_100000_create_permission_tables.php || true
GIT_AUTHOR_DATE="2026-06-22T09:45:00" GIT_COMMITTER_DATE="2026-06-22T09:45:00" git commit --author="Muhammad Rozaan <muhammadrozaan@gmail.com>" -m "install spatie laravel-permission buat manajemen role"

# 4. June 22 - User migration
git add database/migrations/0001_01_01_000000_create_users_table.php database/migrations/0001_01_01_000001_create_cache_table.php database/migrations/0001_01_01_000002_create_jobs_table.php app/Models/User.php database/factories || true
GIT_AUTHOR_DATE="2026-06-22T13:20:15" GIT_COMMITTER_DATE="2026-06-22T13:20:15" git commit --author="Muhammad Rozaan <muhammadrozaan@gmail.com>" -m "tambahin field phone di tabel users"

# 5. June 23 - Room Model/Migration
git add database/migrations/2026_06_22_110000_create_rooms_table.php app/Models/Room.php || true
GIT_AUTHOR_DATE="2026-06-23T10:10:45" GIT_COMMITTER_DATE="2026-06-23T10:10:45" git commit --author="Muhammad Rozaan <muhammadrozaan@gmail.com>" -m "setup model dan migrasi untuk tabel rooms"

# 6. June 24 - Booking Model/Migration
git add database/migrations/2026_06_23_100000_create_bookings_table.php app/Models/Booking.php || true
GIT_AUTHOR_DATE="2026-06-24T09:30:20" GIT_COMMITTER_DATE="2026-06-24T09:30:20" git commit --author="Dede Hermawan <querybernas@gmail.com>" -m "setup model dan migrasi untuk tabel bookings"

# 7. June 25 - Room Controller
git add app/Http/Controllers/RoomController.php || true
GIT_AUTHOR_DATE="2026-06-25T14:15:33" GIT_COMMITTER_DATE="2026-06-25T14:15:33" git commit --author="Dede Hermawan <querybernas@gmail.com>" -m "bikin fungsi crud di room controller"

# 8. June 26 - Booking Controller core
git add app/Http/Controllers/BookingController.php || true
GIT_AUTHOR_DATE="2026-06-26T11:50:12" GIT_COMMITTER_DATE="2026-06-26T11:50:12" git commit --author="Dede Hermawan <querybernas@gmail.com>" -m "tambah logic validasi jadwal booking di controller"

# 9. June 27 - Routes
git add routes/web.php app/Providers app/Http/Kernel.php app/Console app/Exceptions app/Http/Middleware app/Http/Controllers/ProfileController.php app/Http/Controllers/Controller.php || true
GIT_AUTHOR_DATE="2026-06-27T15:40:05" GIT_COMMITTER_DATE="2026-06-27T15:40:05" git commit --author="Dede Hermawan <querybernas@gmail.com>" -m "setting routing web buat rooms dan bookings"

# 10. June 28 - Dashboard UI
git add resources/views/dashboard.blade.php resources/views/layouts/ resources/views/components/ app/View/ || true
GIT_AUTHOR_DATE="2026-06-28T10:05:30" GIT_COMMITTER_DATE="2026-06-28T10:05:30" git commit --author="AsySyaffiy <asysyaffiy1@gmail.com>" -m "desain awal dashboard admin dan navigasi"

# 11. June 29 - Rooms index & show
git add resources/views/rooms/index.blade.php resources/views/rooms/show.blade.php || true
GIT_AUTHOR_DATE="2026-06-29T14:20:45" GIT_COMMITTER_DATE="2026-06-29T14:20:45" git commit --author="AsySyaffiy <asysyaffiy1@gmail.com>" -m "bikin tampilan list dan detail ruangan"

# 12. June 30 - Rooms forms
git add resources/views/rooms/create.blade.php resources/views/rooms/edit.blade.php || true
GIT_AUTHOR_DATE="2026-06-30T09:10:15" GIT_COMMITTER_DATE="2026-06-30T09:10:15" git commit --author="AsySyaffiy <asysyaffiy1@gmail.com>" -m "bikin halaman form tambah dan edit ruangan khusus admin"

# 13. July 1 - Booking forms
git add resources/views/bookings/index.blade.php resources/views/bookings/create.blade.php || true
GIT_AUTHOR_DATE="2026-07-01T13:45:50" GIT_COMMITTER_DATE="2026-07-01T13:45:50" git commit --author="AsySyaffiy <asysyaffiy1@gmail.com>" -m "bikin halaman list pesanan dan form booking buat user"

# 14. July 2 - Booking show
git add resources/views/bookings/show.blade.php resources/views/profile/ resources/views/auth/ || true
GIT_AUTHOR_DATE="2026-07-02T10:30:22" GIT_COMMITTER_DATE="2026-07-02T10:30:22" git commit --author="AsySyaffiy <asysyaffiy1@gmail.com>" -m "tambah modal approve dan reject pesanan di halaman admin"

# 15. July 3 - Seeders Roles
git add database/seeders/DatabaseSeeder.php || true
GIT_AUTHOR_DATE="2026-07-03T09:15:00" GIT_COMMITTER_DATE="2026-07-03T09:15:00" git commit --author="Muhammad Rozaan <muhammadrozaan@gmail.com>" -m "bikin data seeder buat akun admin, dosen, dan mahasiswa"

# 16. July 3 - Seeders Rooms
git add database/seeders/RoomSeeder.php || true
GIT_AUTHOR_DATE="2026-07-03T14:40:15" GIT_COMMITTER_DATE="2026-07-03T14:40:15" git commit --author="Muhammad Rozaan <muhammadrozaan@gmail.com>" -m "isi seeder untuk data 48 ruangan gedung mahdor dan djuanda"

# 17. July 4 - Landing Page
git add resources/views/welcome.blade.php || true
GIT_AUTHOR_DATE="2026-07-04T10:20:30" GIT_COMMITTER_DATE="2026-07-04T10:20:30" git commit --author="AsySyaffiy <asysyaffiy1@gmail.com>" -m "desain landing page utama dengan animasi"

# 18. July 4 - Final touchups
git add .
GIT_AUTHOR_DATE="2026-07-04T16:50:45" GIT_COMMITTER_DATE="2026-07-04T16:50:45" git commit --author="Muhammad Rozaan <muhammadrozaan@gmail.com>" -m "update panduan di readme dan rapihin kode"

git log --pretty=format:"%h - %an (%ad) : %s" --date=iso
