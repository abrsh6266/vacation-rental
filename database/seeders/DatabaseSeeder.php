<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel\Hotel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        Hotel::factory()->create([
            'name' => 'Sheraton',
            'image' => 'image_4.jpg',
            'description' => 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.',
            'location' => 'Addis Ababa, Ambassador',
        ]);

        Hotel::factory()->create([
            'name' => 'Haile Resort',
            'image' => 'image_4.jpg',
            'description' => 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.',
            'location' => 'Hawassa',
        ]);

        Hotel::factory()->create([
            'name' => 'Meskel Plaza',
            'image' => 'services-1.jpg',
            'description' => 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.',
            'location' => 'Addis Ababa, Mexico',
        ]);
    }
}
