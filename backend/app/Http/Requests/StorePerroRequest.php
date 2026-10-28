<?php

namespace App\Http\Requests;

use App\Models\Perro;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

// "Llegó un perro": lo que pide el flujo de 5 pasos. El estado no se recibe: todo perro nuevo queda en_refugio.
class StorePerroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // sin login: un solo perfil (AGENTS.md regla 2)
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:60'],
            'sexo' => ['required', Rule::in(Perro::SEXOS)],
            'como_llego' => ['required', Rule::in(Perro::COMO_LLEGO)],
            'vacunas' => ['required', Rule::in(Perro::VACUNAS)],
            'descripcion' => ['nullable', 'string', 'max:120'],
            'edad_aprox' => ['nullable', 'string', 'max:30'],
            'foto_url' => ['nullable', 'string', 'max:255'],
            'cuidados' => ['nullable', 'string', 'max:255'],
            'llego_el' => ['nullable', 'date', 'before_or_equal:today'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'Escriba cómo se llama el perro, o toque "Todavía no tiene nombre".',
            'nombre.max' => 'El nombre es muy largo: máximo :max letras.',
            'sexo.required' => 'Elija si es macho, hembra o "No sé".',
            'sexo.in' => 'Elija si es macho, hembra o "No sé".',
            'como_llego.required' => 'Elija cómo llegó: bien, flaco, herido o enfermo.',
            'como_llego.in' => 'Elija cómo llegó: bien, flaco, herido o enfermo.',
            'vacunas.required' => 'Elija si tiene vacunas: sí, no o "No sé".',
            'vacunas.in' => 'Elija si tiene vacunas: sí, no o "No sé".',
            'llego_el.date' => 'La fecha de llegada no es válida.',
            'llego_el.before_or_equal' => 'La fecha de llegada no puede ser después de hoy.',
            '*.string' => 'Este dato debe ser texto.',
            '*.max' => 'Este dato es muy largo: máximo :max letras.',
        ];
    }
}
