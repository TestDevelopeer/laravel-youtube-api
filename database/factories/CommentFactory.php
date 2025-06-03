<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    public function configure(): Factory|CommentFactory
    {
        return $this->afterCreating(function (Comment $comment) {
            if ($comment->replies()->exists()) {
                return;
            }

            $comment->parent()->associate($this->findRandomCommentToMakeParentOf($comment))->save();
        });
    }

    private function findRandomCommentToMakeParentOf(Comment $comment): Comment
    {
        return $comment->video
            ->comments()
            ->doesntHave('parent')
            ->where('id', '<>', $comment->id)
            ->inRandomOrder()
            ->first();
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws RandomException
     */
    public function definition(): array
    {
        return [
            'text' => fake()->sentence(random_int(1, 5), true),
            'user_id' => User::inRandomOrder()->first(),
            'video_id' => Video::inRandomOrder()->first(),
        ];
    }
}
