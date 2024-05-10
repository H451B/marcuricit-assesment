<?php

namespace Database\Factories;

use App\Models\Test\Test;
use App\Models\Test\TestComponentTitle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Test\TestComponentTitle>
 */
class TestComponentTitleFactory extends Factory
{
    protected $model = TestComponentTitle::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'test_id' => Test::factory(),
            'title' => $this->faker->word,
        ];
    }
}
