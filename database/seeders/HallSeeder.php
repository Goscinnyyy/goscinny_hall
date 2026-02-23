<?php

namespace Database\Seeders;

use App\Models\Hall;
use Illuminate\Database\Seeder;

class HallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $halls = [
            ['name' => 'Ballroom A', 'pathGambar' => 'ballroom_a.jpg', 'description' => 'Large ballroom with elegant decor', 'price' => 1500000],
            ['name' => 'Ballroom B', 'pathGambar' => 'ballroom_b.jpg', 'description' => 'Spacious ballroom with modern amenities', 'price' => 1800000],
            ['name' => 'Conference Room 1', 'pathGambar' => 'conference_room_1.jpg', 'description' => 'Professional conference room for business meetings', 'price' => 750000],
            ['name' => 'Conference Room 2', 'pathGambar' => 'conference_room_2.jpg', 'description' => 'Smaller conference room for intimate gatherings', 'price' => 750000],
            ['name' => 'Meeting Room', 'pathGambar' => 'meeting_room.jpg', 'description' => 'Compact meeting room suitable for small groups', 'price' => 500000],
            ['name' => 'Garden Pavilion', 'pathGambar' => 'garden_pavilion.jpg', 'description' => 'Beautiful garden pavilion for outdoor events', 'price' => 1200000],
        ];

    }
}
