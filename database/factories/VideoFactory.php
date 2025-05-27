<?php

namespace Database\Factories;

use App\Enums\Period;
use App\Models\Channel;
use App\Models\Video;
use DateTime;
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
//        $fakeDate = $this->faker->dateTimeThisYear();

        $fakeDate = $this->fakeDate();

        return [
            'title' => ucfirst($this->faker->words(random_int(1, 4), true)),
            'description' => $this->faker->paragraph(),
            'channel_id' => Channel::inRandomOrder()->first(),
            'created_at' => $fakeDate,
            'updated_at' => $fakeDate,
        ];
    }

    private function fakeDate(): DateTime
    {
        $period = $this->faker->randomElement(['year', 'month', 'week', 'day', 'hour']);

        return $this->faker->dateTimeBetween("-1 $period");
    }

    public function last(Period $period): Video
    {
        
    }
}
