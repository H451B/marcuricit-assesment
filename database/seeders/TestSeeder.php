<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Test\Test;
use App\Models\Test\TestComponent;
use App\Models\Test\TestComponentTitle;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Test::factory(10)->create();
        TestComponent::factory(20)->create();
        TestComponentTitle::factory(5)->create();
    }
}
