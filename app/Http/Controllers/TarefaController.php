<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tarefa\StoreTarefaRequest;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class TarefaController extends Controller
{
    public function __construct() {
        $this->authorizeResource(Tarefa::class, 'tarefa');
    }

    public function index(): Response
    {
        $tarefas = Tarefa::all();

        return Inertia::render('Tarefa/Index', ['tarefas' => Auth::user()->tarefas]);
    }

    public function store(StoreTarefaRequest $request)
    {
        Auth::user()->tarefas()->create($request->validated());

        return Redirect::route('tarefas.index')->with('success', 'Tarefa Criada.');
    }

    public function update(StoreTarefaRequest $request, Tarefa $tarefa)
    {
        $tarefa->update($request->validated());

        return Redirect::route('tarefas.index')->with('success', 'Tarefa Atualizada');
    }

    public function destroy(Tarefa $tarefa)
    {
        $tarefa->delete();

        return Redirect::route('tarefas.index')->with('success', 'Tarefa Delatada com sucesso!');
    }

}
