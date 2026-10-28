<?php

namespace App\Models;

use App\Models\Concerns\FechasDeBogota;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('reportes')]
#[Fillable(['perro_id', 'sintomas', 'nota_voz_url', 'creado_en'])]
class Reporte extends Model
{
    use FechasDeBogota;

    public const SINTOMAS = ['no_comio', 'comio_poco', 'decaido', 'vomito', 'diarrea', 'cojea', 'tose', 'herida'];

    // El contrato usa creado_en y no hay fecha de cambio: un reporte se borra, no se edita.
    public const CREATED_AT = 'creado_en';

    public const UPDATED_AT = null;

    protected function casts(): array
    {
        return [
            'sintomas' => 'array',
            'creado_en' => 'datetime',
        ];
    }

    public function perro(): BelongsTo
    {
        return $this->belongsTo(Perro::class);
    }
}
