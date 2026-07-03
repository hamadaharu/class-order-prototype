<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run()
    {
        // Gedung Mahdor (Lantai 1-4, Ruang 1-6)
        for ($floor = 1; $floor <= 4; $floor++) {
            for ($roomNum = 1; $roomNum <= 6; $roomNum++) {
                $code = "M-{$floor}0{$roomNum}";
                Room::firstOrCreate(
                    ['code' => $code],
                    [
                        'name' => "Ruang Kelas Mahdor {$floor}0{$roomNum}",
                        'location' => "Gedung Mahdor, Lantai {$floor}",
                        'capacity' => 40,
                        'facilities' => ['AC', 'Proyektor', 'Whiteboard'],
                        'is_active' => true,
                    ]
                );
            }
        }

        // Gedung Djuanda (Lantai 3-6, Ruang 1-6)
        for ($floor = 3; $floor <= 6; $floor++) {
            for ($roomNum = 1; $roomNum <= 6; $roomNum++) {
                $code = "D-{$floor}0{$roomNum}";
                Room::firstOrCreate(
                    ['code' => $code],
                    [
                        'name' => "Ruang Kelas Djuanda {$floor}0{$roomNum}",
                        'location' => "Gedung Djuanda, Lantai {$floor}",
                        'capacity' => 40,
                        'facilities' => ['AC', 'Proyektor', 'Whiteboard'],
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}
