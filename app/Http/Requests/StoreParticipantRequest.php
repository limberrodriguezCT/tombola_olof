<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreParticipantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_completo' => 'required|string|max:255|unique:participants,nombre_completo',
            'tipo_procedencia' => 'required|string|max:255',
            'departamento' => 'required|string|max:255',
            'centro_procedencia' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre_completo.required' => 'El nombre completo es obligatorio.',
            'nombre_completo.unique' => 'Este participante ya se encuentra registrado en el sistema.',
            'tipo_procedencia.required' => 'Debe seleccionar un tipo de procedencia.',
            'departamento.required' => 'El departamento es obligatorio.',
            'centro_procedencia.required' => 'El centro de procedencia es obligatorio.',
        ];
    }
}