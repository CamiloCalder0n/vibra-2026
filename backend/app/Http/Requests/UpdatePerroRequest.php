<?php

namespace App\Http\Requests;

use App\Models\Perro;
use Illuminate\Validation\Rule;

// "Cambiar datos" (PATCH): solo se valida lo que llega; lo obligatorio al crear no se puede dejar vacío.
// Aquí sí se puede cambiar el estado (p. ej. cuando lo adoptan).
class UpdatePerroRequest extends StorePerroRequest
{
    // Al cambiar datos no se toca la fecha de llegada.
    protected function prepareForValidation(): void {}

    public function rules(): array
    {
        return array_map(fn (array $reglas) => ['sometimes', ...$reglas], parent::rules())
            + ['estado' => ['sometimes', 'required', Rule::in(Perro::ESTADOS)]];
    }

    public function messages(): array
    {
        return parent::messages() + [
            'estado.required' => 'Elija si sigue en el refugio o si ya lo adoptaron.',
            'estado.in' => 'Elija si sigue en el refugio o si ya lo adoptaron.',
        ];
    }
}
