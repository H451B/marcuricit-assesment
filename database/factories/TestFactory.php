<?php

namespace Database\Factories;

use App\Models\Test\Test;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Test\Test>
 */
class TestFactory extends Factory
{
    protected $model = Test::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'shortcut' => $this->faker->word,
            'sample_type' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'precautions' => $this->faker->sentence,
        ];
    }
}
