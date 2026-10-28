<?php

namespace App\Models;

use App\Models\Concerns\FechasDeBogota;
use App\Services\EstadoDeHoy;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('dosis')]
#[Fillable(['tratamiento_id', 'programada_para', 'dada_en'])]
class Dosis extends Model
{
    use FechasDeBogota;

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

    // La que sigue en el mismo tratamiento, o null si esta era la última.
    public function proxima(): ?self
    {
        return self::where('tratamiento_id', $this->tratamiento_id)
            ->where('programada_para', '>', $this->programada_para)
            ->orderBy('programada_para')
            ->first();
    }

    // "Rocco ya se tomó la cefalexina a las 3:05 p. m. La próxima es a las 2:00 a. m."
    public function textoYaDada(): string
    {
        $tratamiento = $this->tratamiento;
        $proxima = $this->proxima();

        return "{$tratamiento->perro->nombre} ya se tomó ".self::conArticulo($tratamiento->medicamento)
            .' a las '.EstadoDeHoy::hora($this->dada_en).' '
            .($proxima ? 'La próxima es a las '.EstadoDeHoy::hora($proxima->programada_para) : 'Era la última del tratamiento.');
    }

    // la cefalexina, las gotas para el ojo, el meloxicam: por cómo termina la primera palabra.
    private static function conArticulo(string $medicamento): string
    {
        $nombre = mb_strtolower($medicamento);
        $palabra = strtok($nombre, ' ');

        $articulo = match (true) {
            str_ends_with($palabra, 'as') => 'las',
            str_ends_with($palabra, 'a') => 'la',
            str_ends_with($palabra, 's') => 'los',
            default => 'el',
        };

        return $articulo.' '.$nombre;
    }
}
