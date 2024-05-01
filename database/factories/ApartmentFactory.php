<?php

namespace Database\Factories;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApartmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Apartment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'image' => 'default_image.jpg',
            'max_persons' => $this->faker->numberBetween(1, 6),
            'size' => $this->faker->numberBetween(50, 200),
            'num_beds' => $this->faker->numberBetween(1, 4),
            'view' => $this->faker->randomElement(['Ocean', 'City', 'Mountain']),
            'hotel_id' => $this->faker->numberBetween(1, 3), // Assuming you have 3 hotels seeded already
        ];
    }
}
