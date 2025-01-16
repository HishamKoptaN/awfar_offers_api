<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'image' => 'https://api.awfar-offers.com/storage/product.jpg',
            'price' => $this->faker->randomElement(
                range(
                    1000,
                    10000,
                ),
            ),
            'discount_rate' => $this->faker->randomElement(
                [
                    5,
                    10,
                    15,
                    20,
                ],
            ),
            'offer_id' => $this->faker->randomElement(
                range(
                    1,
                    900,
                ),
            ),
            'marka_id' => $this->faker->randomElement(
                range(
                    1,
                    300,
                ),
            ),
        ];
    }
}
