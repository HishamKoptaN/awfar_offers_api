<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MarkaFactory extends Factory
{
    protected static $counter = 1;

    public function definition()
    {
        $baseName = 'marka';
        $currentNumber = self::$counter++;
        return [
            'name' => $baseName . ' ' . $currentNumber,
            'sub_category_id' => $this->faker->randomElement(
                range(1, 75)
            ),
        ];
    }
}
