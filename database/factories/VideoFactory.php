<?php

namespace Database\Factories;

use App\Enums\Period;
use App\Models\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws RandomException
     */
    public function definition(): array
    {
        return [
            'title' => ucfirst(fake()->words(random_int(1, 4), true)),
            'description' => fake()->paragraph(random_int(1, 3)),
            'channel_id' => Channel::inRandomOrder()->first(),
        ];
    }

    public function last(Period $period): VideoFactory|Factory
    {
        return $this->state(function () use ($period) {
            $fakeDate = fake()->dateTimeBetween("-1 $period->value");

            return [
                'created_at' => $fakeDate,
                'updated_at' => $fakeDate,
            ];
        });
    }
}
