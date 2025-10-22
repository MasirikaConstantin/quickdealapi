<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Str;

class MessageFactory extends Factory
{
    protected $model = \App\Models\Message::class;

    public function definition()
    {
        $conversationIds = Conversation::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();

        return [
            'conversation_id' => $this->faker->randomElement($conversationIds),
            'user_id' => $this->faker->randomElement($userIds),
            'message' => $this->faker->paragraph(),
            'est_lu' => $this->faker->boolean(70),
            'piece_jointe' => $this->faker->boolean(20) ? $this->faker->imageUrl(400, 400) : null,
            'ref' => $this->faker->uuid(),
        ];
    }
}
