<?php

namespace App\Models\Concerns;

use DateTimeInterface;
use Illuminate\Support\Carbon;

// En el JSON, las fechas con hora salen en ISO con la zona de Bogotá ("2026-10-29T15:05:00-05:00"), no en UTC.
// Las fechas sin hora usan el cast `date:Y-m-d` en cada modelo.
trait FechasDeBogota
{
    protected function serializeDate(DateTimeInterface $date): string
    {
        return Carbon::instance($date)->setTimezone(config('app.timezone'))->toIso8601String();
    }
}
