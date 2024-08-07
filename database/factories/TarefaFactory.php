<?php

namespace Database\Factories;

use App\Models\Tarefa;
use App\Models\User;
use Illuminate\Console\View\Components\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarefa>
 */
class TarefaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->sentence,
            'prioridade' => Tarefa::PRIORIDADES[array_rand(Tarefa::PRIORIDADES)],
            'status' => Tarefa::STATUSES[array_rand(Tarefa::STATUSES)],
            'user_id' => User::factory(),
            'vencimento' => fake()->dateTimeBetween('+0 days', '+2 weeks')->format('Y-m-d')
        ];
    }
}
