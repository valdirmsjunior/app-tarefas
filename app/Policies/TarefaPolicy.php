<?php

namespace App\Policies;

use App\Models\Tarefa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TarefaPolicy
{
    public function viewAny(?User $user): bool
    {
        return $user->id === Auth::user()->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Tarefa $tarefa): bool
    {
        return $user->id === $tarefa->user_id;
    }

    public function delete(User $user, Tarefa $tarefa): bool
    {
        return $user->id === $tarefa->user_id;
    }
}
