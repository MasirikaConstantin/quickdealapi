<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Str;

class NotificationFactory extends Factory
{
    protected $model = \App\Models\Notification::class;

    public function definition()
    {
        $userIds = User::pluck('id')->toArray();
        $types = ['nouvelle_commande', 'nouveau_message', 'avis_recu'];

        $estLue = $this->faker->boolean(50);

        return [
            'user_id' => $this->faker->randomElement($userIds),
            'type' => $this->faker->randomElement($types),
            'message' => $this->faker->sentence(10),
            'donnees' => json_encode([
                'id' => $this->faker->numberBetween(1, 100),
                'extra_info' => $this->faker->word(),
            ]),
            'est_lue' => $estLue,
            'lue_le' => $estLue ? $this->faker->dateTimeBetween('-10 days', 'now') : null,
            'ref' => $this->faker->uuid(),
        ];
    }
}
