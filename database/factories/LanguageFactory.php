<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Language>
 */
class LanguageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'languages' => $this->faker->randomElement([
                'Python',
                'JavaScript',
                'Java',
                'C++',
                'Ruby',
                'PHP',
                'Swift',
                'Go',
                'Kotlin',
                'Rust'
            ]),
        ];
    }
}
