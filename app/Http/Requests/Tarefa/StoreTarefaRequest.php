<?php

namespace App\Http\Requests\Tarefa;

use App\Models\Tarefa;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class StoreTarefaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|string|min:3|max:255',
            'prioridade' => 'required|in:' .implode(',', Tarefa::PRIORIDADES),
            'status' => 'required|in:' . implode(',', Tarefa::STATUSES),
            'vencimento' => 'required|after:' . date('d-m-Y')
        ];
    }
}
