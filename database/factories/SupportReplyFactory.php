<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Support;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SupportReply>
 */
class SupportReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => Str::uuid(),
            'support_id' => Support::factory(),
            'user_id' => User::factory(),
            'description' => $this->faker->sentence(20),
        ];
    }
}
