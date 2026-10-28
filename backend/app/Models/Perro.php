<?php

namespace App\Models;

use App\Models\Concerns\FechasDeBogota;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

#[Table('perros')]
#[Fillable(['nombre', 'sexo', 'descripcion', 'edad_aprox', 'foto_url', 'como_llego', 'vacunas', 'cuidados', 'llego_el', 'estado'])]
class Perro extends Model
{
    use FechasDeBogota;

    public const SEXOS = ['macho', 'hembra', 'no_se'];

    public const COMO_LLEGO = ['bien', 'flaco', 'herido', 'enfermo'];

    public const VACUNAS = ['si', 'no', 'no_se'];

    public const ESTADOS = ['en_refugio', 'adoptado'];

    protected $attributes = ['estado' => 'en_refugio'];

    protected function casts(): array
    {
        return [
            'llego_el' => 'date:Y-m-d',
        ];
    }

    public function reportes(): HasMany
    {
        return $this->hasMany(Reporte::class);
    }

    public function tratamientos(): HasMany
    {
        return $this->hasMany(Tratamiento::class);
    }

    public function dosis(): HasManyThrough
    {
        return $this->hasManyThrough(Dosis::class, Tratamiento::class);
    }

    // Reportes de los últimos 7 días (de hace 6 días a hoy), los que usan Hoy y la ficha.
    public function reportesRecientes(): HasMany
    {
        return $this->reportes()->where('creado_en', '>=', today()->subDays(6))->orderBy('creado_en');
    }

    public function dosisDeHoy(): HasManyThrough
    {
        return $this->dosis()->whereBetween('programada_para', [today(), today()->endOfDay()])->orderBy('programada_para');
    }

    // No se llama vacunas() porque la columna `vacunas` (si | no | no_se) taparía la relación.
    public function registroVacunas(): HasMany
    {
        return $this->hasMany(Vacuna::class);
    }

    #[Scope]
    protected function enRefugio(Builder $query): void
    {
        $query->where('estado', 'en_refugio');
    }

    // Carga lo que necesita EstadoDeHoy en pocas consultas.
    #[Scope]
    protected function conLoDeHoy(Builder $query): void
    {
        $query->with(['reportesRecientes', 'dosisDeHoy.tratamiento']);
    }
}
