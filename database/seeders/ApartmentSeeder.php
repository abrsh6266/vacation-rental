<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create three apartments using the ApartmentFactory
        \App\Models\Apartment\Apartment::factory()->count(3)->create();
    }
}
