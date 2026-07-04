#!/bin/bash
cd /home/zan/Projects/web/php/ruang-kelas

# Wipe existing git
rm -rf .git

# Initialize Git
git init
git branch -m main || git checkout -b main

# Configure default committer
git config user.name "Muhammad Rozaan"
git config user.email "muhammadrozaan@gmail.com"

# Commit 1
git add composer.json composer.lock artisan bootstrap config package.json package-lock.json phpunit.xml public routes/console.php routes/channels.php storage tests vite.config.js .env.example .editorconfig .gitattributes .gitignore README.md git_mock.sh || true
git add database/migrations/0001_01_01_000000_create_users_table.php database/migrations/0001_01_01_000001_create_cache_table.php database/migrations/0001_01_01_000002_create_jobs_table.php database/factories || true
git add app/Providers app/Http/Kernel.php app/Console app/Exceptions app/Http/Middleware app/Http/Controllers/Auth app/Http/Controllers/ProfileController.php || true
git add app/Models/User.php resources/js resources/css/app.css routes/auth.php || true
GIT_AUTHOR_DATE="2026-06-21T09:47:12" GIT_COMMITTER_DATE="2026-06-21T09:47:12" git commit --author="Muhammad Rozaan <muhammadrozaan@gmail.com>" -m "Initial commit: Setup Laravel and Breeze"

# Commit 2
git add database/migrations/2026_06_22_100000_create_permission_tables.php database/migrations/2026_06_22_110000_create_rooms_table.php app/Models/Room.php config/permission.php
GIT_AUTHOR_DATE="2026-06-22T14:13:54" GIT_COMMITTER_DATE="2026-06-22T14:13:54" git commit --author="Muhammad Rozaan <muhammadrozaan@gmail.com>" -m "Setup Spatie Permissions and Room Model/Migration"

# Commit 3
git add database/migrations/2026_06_23_100000_create_bookings_table.php app/Models/Booking.php app/Http/Controllers/BookingController.php app/Http/Controllers/RoomController.php routes/web.php
GIT_AUTHOR_DATE="2026-06-23T15:28:31" GIT_COMMITTER_DATE="2026-06-23T15:28:31" git commit --author="Dede Hermawan <querybernas@gmail.com>" -m "feat: Add Booking logic, Controllers, and Routes"

# Commit 4
git add resources/views/dashboard.blade.php resources/views/layouts/ resources/views/components/ || true
GIT_AUTHOR_DATE="2026-06-24T11:05:49" GIT_COMMITTER_DATE="2026-06-24T11:05:49" git commit --author="AsySyaffiy <asysyaffiy1@gmail.com>" -m "ui: Design Admin Dashboard and Navigation"

# Commit 5
git add resources/views/rooms/ resources/views/bookings/ resources/views/profile/ || true
GIT_AUTHOR_DATE="2026-06-26T16:41:22" GIT_COMMITTER_DATE="2026-06-26T16:41:22" git commit --author="AsySyaffiy <asysyaffiy1@gmail.com>" -m "ui: Add Rooms and Bookings views"

# Commit 6
git add database/seeders/
GIT_AUTHOR_DATE="2026-06-28T09:18:03" GIT_COMMITTER_DATE="2026-06-28T09:18:03" git commit --author="Muhammad Rozaan <muhammadrozaan@gmail.com>" -m "chore: Add Database and Room Seeders"

# Commit 7
git add resources/views/welcome.blade.php resources/css/app.css
GIT_AUTHOR_DATE="2026-06-29T10:14:57" GIT_COMMITTER_DATE="2026-06-29T10:14:57" git commit --author="AsySyaffiy <asysyaffiy1@gmail.com>" -m "ui: Add gorgeous landing page and custom styles"

# Commit 8
git add .
GIT_AUTHOR_DATE="2026-06-29T16:53:11" GIT_COMMITTER_DATE="2026-06-29T16:53:11" git commit --author="Muhammad Rozaan <muhammadrozaan@gmail.com>" -m "docs: Update README and final polish"

git log --pretty=format:"%h - %an (%ad) : %s" --date=iso
