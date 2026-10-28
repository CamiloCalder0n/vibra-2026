<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('vacunas')]
#[Fillable(['perro_id', 'nombre', 'aplicada_el'])]
class Vacuna extends Model
{
    public const NOMBRES = ['moquillo', 'parvovirus', 'rabia'];

    protected function casts(): array
    {
        return [
            'aplicada_el' => 'date',
        ];
    }

    public function perro(): BelongsTo
    {
        return $this->belongsTo(Perro::class);
    }
}
