<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Test\Test;
use App\Models\Test\TestComponent;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Test\TestComponent>
 */
class TestComponentFactory extends Factory
{
    protected $model = TestComponent::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'test_id' => Test::factory(),
            'name' => $this->faker->word,
            'unit' => $this->faker->word,
            'result' => $this->faker->randomElement(['text', 'select']),
            'reference_range' => $this->faker->sentence,
            'separated' => $this->faker->boolean,
            'price' => $this->faker->randomFloat(2, 5, 50),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
