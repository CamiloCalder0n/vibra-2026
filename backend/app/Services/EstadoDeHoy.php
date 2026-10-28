<?php

namespace App\Services;

use App\Models\Dosis;
use App\Models\Perro;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

// Cómo está un perro hoy, calculado en PHP con la hora de Bogotá (AGENTS.md sección 4, reglas).
// "Necesita atención" = reporte ayer u hoy, medicina pendiente hoy hasta la hora actual, o llegó hace 3 días o menos.
// Usa las relaciones reportesRecientes y dosisDeHoy (cárguelas con Perro::conLoDeHoy() para no hacer una consulta por perro).
class EstadoDeHoy
{
    // Para escoger el síntoma principal de un día: el más serio primero.
    private const GRAVEDAD = ['herida', 'vomito', 'diarrea', 'no_comio', 'decaido', 'cojea', 'tose', 'comio_poco'];

    // "Lleva 2 días ..."
    private const VARIOS_DIAS = [
        'no_comio' => 'sin comer', 'comio_poco' => 'comiendo poco', 'decaido' => 'decaíd%s', 'vomito' => 'vomitando',
        'diarrea' => 'con diarrea', 'cojea' => 'cojeando', 'tose' => 'tosiendo', 'herida' => 'con una herida',
    ];

    // "Hoy ..."
    private const HOY = [
        'no_comio' => 'no comió', 'comio_poco' => 'comió poco', 'decaido' => 'está decaíd%s', 'vomito' => 'vomitó',
        'diarrea' => 'tiene diarrea', 'cojea' => 'cojea', 'tose' => 'tose', 'herida' => 'tiene una herida',
    ];

    // "Ayer ..."
    private const AYER = [
        'no_comio' => 'no comió', 'comio_poco' => 'comió poco', 'decaido' => 'estuvo decaíd%s', 'vomito' => 'vomitó',
        'diarrea' => 'tuvo diarrea', 'cojea' => 'cojeaba', 'tose' => 'tosió', 'herida' => 'tenía una herida',
    ];

    /** @var array<string, list<string>> síntomas por día (AAAA-MM-DD) en los últimos 7 días */
    private array $sintomasPorDia;

    public function __construct(public readonly Perro $perro)
    {
        $this->sintomasPorDia = $perro->reportesRecientes
            ->groupBy(fn ($reporte) => $reporte->creado_en->toDateString())
            ->map(fn (Collection $reportes) => $reportes->pluck('sintomas')->flatten()->unique()->values()->all())
            ->all();
    }

    /** @return list<string> mal | medicina | nuevo, en orden de importancia */
    public function motivos(): array
    {
        if ($this->perro->estado !== 'en_refugio') {
            return [];
        }

        return array_values(array_filter([
            $this->rachaHasta(today()) > 0 || $this->rachaHasta(today()->subDay()) > 0 ? 'mal' : null,
            $this->dosisPendientes()->isNotEmpty() ? 'medicina' : null,
            $this->perro->llego_el->gte(today()->subDays(3)) ? 'nuevo' : null,
        ]));
    }

    public function necesita(): bool
    {
        return $this->motivos() !== [];
    }

    // mal | medicina | nuevo | bien | adoptado
    public function estadoHoy(): string
    {
        if ($this->perro->estado === 'adoptado') {
            return 'adoptado';
        }

        return $this->motivos()[0] ?? 'bien';
    }

    // "Llame al veterinario" = 3 días seguidos con reporte, contando hoy.
    public function alerta(): bool
    {
        return $this->rachaHasta(today()) >= 3;
    }

    public function textoAlerta(): ?string
    {
        return $this->alerta()
            ? "{$this->perro->nombre} lleva {$this->rachaHasta(today())} días seguidos mal. Llame al veterinario."
            : null;
    }

    // Una línea para la tarjeta de Hoy, según el motivo más importante.
    public function motivo(): ?string
    {
        return match ($this->motivos()[0] ?? null) {
            'mal' => $this->textoMal(),
            'medicina' => $this->textoMedicina(),
            'nuevo' => $this->textoNuevo(),
            default => null,
        };
    }

    /** @return Collection<int, Dosis> dosis de hoy sin dar cuya hora ya llegó */
    public function dosisPendientes(): Collection
    {
        return $this->perro->dosisDeHoy
            ->filter(fn (Dosis $dosis) => $dosis->dada_en === null && $dosis->programada_para->lte(now()))
            ->values();
    }

    /** @return list<string> del más viejo a hoy: "bien" o el síntoma principal de ese día */
    public function ultimos7Dias(): array
    {
        return collect(range(6, 0))
            ->map(fn (int $hace) => $this->principal($this->sintomasPorDia[today()->subDays($hace)->toDateString()] ?? []) ?? 'bien')
            ->all();
    }

    public static function hora(Carbon $momento): string
    {
        return $momento->format('g:i').($momento->hour < 12 ? ' a. m.' : ' p. m.');
    }

    // Días distintos seguidos con reporte que terminan en $dia.
    private function rachaHasta(Carbon $dia): int
    {
        $racha = 0;
        while (isset($this->sintomasPorDia[$dia->copy()->subDays($racha)->toDateString()])) {
            $racha++;
        }

        return $racha;
    }

    private function principal(array $sintomas): ?string
    {
        return collect(self::GRAVEDAD)->first(fn ($sintoma) => in_array($sintoma, $sintomas, true));
    }

    // "Lleva 2 días comiendo poco", "Lleva 2 días comiendo poco y hoy está decaída", "Ayer vomitó", "Hoy cojea".
    private function textoMal(): string
    {
        $hoy = $this->sintomasPorDia[today()->toDateString()] ?? null;
        $antes = $this->rachaHasta(today()->subDay());
        $deAntes = $this->principal(collect(range(1, max($antes, 1)))
            ->flatMap(fn ($hace) => $this->sintomasPorDia[today()->subDays($hace)->toDateString()] ?? [])
            ->countBy()->sortDesc()->keys()->take(1)->all());
        $deHoy = $hoy ? $this->principal($hoy) : null;

        if ($hoy && $antes === 0) {
            return 'Hoy '.$this->frase(self::HOY, $deHoy);
        }
        if ($hoy && $deHoy === $deAntes) {
            return 'Lleva '.($antes + 1).' días '.$this->frase(self::VARIOS_DIAS, $deAntes);
        }
        if ($hoy) {
            return 'Lleva '.$antes.' '.($antes === 1 ? 'día' : 'días').' '.$this->frase(self::VARIOS_DIAS, $deAntes).' y hoy '.$this->frase(self::HOY, $deHoy);
        }

        return $antes === 1
            ? 'Ayer '.$this->frase(self::AYER, $deAntes)
            : 'Lleva '.$antes.' días '.$this->frase(self::VARIOS_DIAS, $deAntes);
    }

    private function textoMedicina(): string
    {
        $dosis = $this->dosisPendientes()->first();

        return 'Falta darle '.mb_strtolower($dosis->tratamiento->medicamento).' de las '.self::hora($dosis->programada_para);
    }

    private function textoNuevo(): string
    {
        $dias = (int) $this->perro->llego_el->diffInDays(today());
        $cuando = match ($dias) {
            0 => 'Llegó hoy',
            1 => 'Llegó ayer',
            default => "Llegó hace {$dias} días",
        };

        return $cuando.': que '.($this->perro->sexo === 'hembra' ? 'la' : 'lo').' revise el veterinario';
    }

    private function frase(array $frases, string $sintoma): string
    {
        return sprintf($frases[$sintoma], $this->perro->sexo === 'hembra' ? 'a' : 'o');
    }
}
