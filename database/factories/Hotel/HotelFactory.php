<?php

namespace Database\Factories\Hotel;

use App\Models\Hotel\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hotel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'image' => 'default_image.jpg',
            'description' => $this->faker->paragraph,
            'location' => $this->faker->city,
        ];
    }
}
