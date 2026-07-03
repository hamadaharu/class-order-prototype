<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Roles
        $adminRole = Role::create(['name' => 'admin']);
        $dosenRole = Role::create(['name' => 'dosen']);
        $mahasiswaRole = Role::create(['name' => 'mahasiswa']);

        // 2. Create Admin User
        $admin = User::factory()->create([
            'name' => 'Admin System',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole($adminRole);

        // 3. Create Dosen User
        $dosen = User::factory()->create([
            'name' => 'Dosen John',
            'email' => 'dosen@example.com',
            'password' => Hash::make('password'),
        ]);
        $dosen->assignRole($dosenRole);

        // 4. Create Mahasiswa User
        $mahasiswa = User::factory()->create([
            'name' => 'Mahasiswa Doe',
            'email' => 'mahasiswa@example.com',
            'password' => Hash::make('password'),
        ]);
        $mahasiswa->assignRole($mahasiswaRole);

        // 5. Create Dummy Rooms
        $roomA = Room::create([
            'code' => 'R-101',
            'name' => 'Ruang Kelas 101',
            'location' => 'Gedung A, Lantai 1',
            'capacity' => 40,
            'facilities' => ['AC', 'Proyektor', 'Whiteboard'],
        ]);

        $roomB = Room::create([
            'code' => 'R-102',
            'name' => 'Lab Komputer 1',
            'location' => 'Gedung B, Lantai 1',
            'capacity' => 30,
            'facilities' => ['AC', 'PC', 'Proyektor'],
        ]);

        $roomC = Room::create([
            'code' => 'R-201',
            'name' => 'Ruang Seminar',
            'location' => 'Gedung A, Lantai 2',
            'capacity' => 100,
            'facilities' => ['AC', 'Proyektor', 'Sound System'],
        ]);

        // 6. Create Dummy Bookings
        Booking::create([
            'user_id' => $dosen->id,
            'room_id' => $roomA->id,
            'start_at' => Carbon::now()->addDays(1)->setHour(8)->setMinute(0)->setSecond(0),
            'end_at' => Carbon::now()->addDays(1)->setHour(10)->setMinute(0)->setSecond(0),
            'purpose' => 'Kuliah Pemrograman Web',
            'status' => 'approved',
            'approved_by' => $admin->id,
        ]);

        Booking::create([
            'user_id' => $mahasiswa->id,
            'room_id' => $roomB->id,
            'start_at' => Carbon::now()->addDays(2)->setHour(13)->setMinute(0)->setSecond(0),
            'end_at' => Carbon::now()->addDays(2)->setHour(15)->setMinute(0)->setSecond(0),
            'purpose' => 'Belajar Kelompok',
            'status' => 'pending',
        ]);
    }
}
