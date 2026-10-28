<?php

namespace App\Models;

use App\Models\Concerns\FechasDeBogota;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('tratamientos')]
#[Fillable(['perro_id', 'medicamento', 'dosis', 'horas', 'desde', 'hasta'])]
class Tratamiento extends Model
{
    use FechasDeBogota;

    protected function casts(): array
    {
        return [
            'horas' => 'array',
            'desde' => 'date:Y-m-d',
            'hasta' => 'date:Y-m-d',
        ];
    }

    public function perro(): BelongsTo
    {
        return $this->belongsTo(Perro::class);
    }

    // `dosis` también es una columna (texto "1 pastilla"), por eso la relación es tomas().
    public function tomas(): HasMany
    {
        return $this->hasMany(Dosis::class);
    }
}
