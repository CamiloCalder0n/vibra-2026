<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('dosis')]
#[Fillable(['tratamiento_id', 'programada_para', 'dada_en'])]
class Dosis extends Model
{
    protected function casts(): array
    {
        return [
            'programada_para' => 'datetime',
            'dada_en' => 'datetime',
        ];
    }

    public function tratamiento(): BelongsTo
    {
        return $this->belongsTo(Tratamiento::class);
    }
}
