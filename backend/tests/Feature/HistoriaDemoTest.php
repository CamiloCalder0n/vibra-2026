<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

// La historia de la demo (docs/evento/flujos.md sección 3), vista a la hora de la presentación.
class HistoriaDemoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->travelTo(Carbon::parse('2026-10-29 15:00', 'America/Bogota'));
        $this->seed();
    }

    public function test_hoy_hay_3_que_necesitan_y_31_bien(): void
    {
        $this->getJson('/api/hoy')
            ->assertOk()
            ->assertJsonPath('fecha', '2026-10-29')
            ->assertJsonPath('en_refugio', 34)
            ->assertJsonPath('bien', 31)
            ->assertJsonPath('necesitan.*.nombre', ['Nube', 'Rocco', 'Bruno'])
            ->assertJsonPath('necesitan.0.motivo', 'Lleva 2 días comiendo poco')
            ->assertJsonPath('necesitan.0.alerta', false)
            ->assertJsonPath('medicinas_pendientes', [
                ['dosis_id' => 7, 'perro' => 'Rocco', 'medicamento' => 'Cefalexina', 'hora' => '14:00'],
            ]);
    }

    public function test_reportar_a_nube_decaida_saca_el_aviso_y_deshacer_lo_quita(): void
    {
        $respuesta = $this->postJson('/api/perros/2/reportes', ['sintomas' => ['decaido']])
            ->assertCreated()
            ->assertJsonPath('mensaje', 'Listo, quedó guardado lo de Nube')
            ->assertJsonPath('alerta', 'Nube lleva 3 días seguidos mal. Llame al veterinario.');

        $this->getJson('/api/hoy')
            ->assertJsonPath('necesitan.0.nombre', 'Nube')
            ->assertJsonPath('necesitan.0.alerta', true)
            ->assertJsonPath('necesitan.0.motivo', 'Lleva 2 días comiendo poco y hoy está decaída')
            ->assertJsonPath('bien', 31);

        $this->getJson('/api/perros/2')
            ->assertJsonPath('ultimos_7_dias', ['bien', 'bien', 'bien', 'bien', 'comio_poco', 'comio_poco', 'decaido'])
            ->assertJsonPath('alerta', 'Nube lleva 3 días seguidos mal. Llame al veterinario.');

        $this->deleteJson('/api/reportes/'.$respuesta->json('id'))->assertNoContent();

        $this->getJson('/api/hoy')->assertJsonPath('necesitan.0.alerta', false);
        $this->getJson('/api/perros/2')->assertJsonPath('alerta', null);
    }

    public function test_filtros_de_mis_perros(): void
    {
        $this->getJson('/api/perros')->assertOk()->assertJsonCount(34);
        $this->getJson('/api/perros?filtro=mal')->assertJsonPath('*.nombre', ['Nube']);
        $this->getJson('/api/perros?filtro=medicina')->assertJsonPath('*.nombre', ['Rocco']);
        $this->getJson('/api/perros?filtro=nuevos')->assertJsonPath('*.nombre', ['Bruno']);
        $this->getJson('/api/perros?filtro=raro')->assertUnprocessable()->assertJsonPath('errores.filtro.0', 'El filtro debe ser mal, medicina o nuevos.');
    }

    public function test_ficha_de_toby_y_fechas_del_json(): void
    {
        $this->getJson('/api/perros/3')
            ->assertOk()
            ->assertJsonPath('cuidados', 'No se la lleva bien con otros machos. Póngalo con hembras.')
            ->assertJsonPath('estado_hoy', 'bien');

        $nube = $this->getJson('/api/perros/2')->json();
        $this->assertMatchesRegularExpression('/^\d{4}-\d{2}-\d{2}$/', $nube['llego_el']);
        $this->assertSame('2026-10-28T08:20:00-05:00', $nube['reportes'][0]['creado_en']);
        $this->assertSame('moquillo', $nube['vacunas'][0]['nombre']);
        $this->assertNull($nube['vacunas'][0]['aplicada_el']);
    }

    public function test_llega_lucero_y_luego_la_adoptan(): void
    {
        $lucero = $this->postJson('/api/perros', ['nombre' => 'Lucero', 'sexo' => 'hembra', 'como_llego' => 'flaco', 'vacunas' => 'no_se'])
            ->assertCreated()
            ->assertJsonPath('llego_el', '2026-10-29')
            ->assertJsonPath('mensaje', 'Bienvenido, Lucero. Ya está en Mis perros.')
            ->json('id');

        $this->getJson('/api/hoy')->assertJsonPath('en_refugio', 35)->assertJsonPath('necesitan.*.nombre', ['Nube', 'Rocco', 'Bruno', 'Lucero']);

        $this->patchJson("/api/perros/{$lucero}", ['estado' => 'adoptado'])->assertOk()->assertJsonPath('estado_hoy', 'adoptado');
        $this->getJson('/api/hoy')->assertJsonPath('en_refugio', 34)->assertJsonPath('bien', 31);
    }

    public function test_errores_con_el_formato_del_contrato(): void
    {
        $this->postJson('/api/perros', ['nombre' => ''])->assertUnprocessable()->assertJsonStructure(['mensaje', 'errores' => ['nombre', 'sexo', 'como_llego', 'vacunas']]);
        $this->postJson('/api/perros/2/reportes', ['sintomas' => []])->assertUnprocessable()->assertJsonPath('errores.sintomas.0', 'Toque lo que le pasa a Nube.');
        $this->getJson('/api/perros/999')->assertNotFound()->assertJsonPath('mensaje', 'No encontramos lo que busca.');
        $this->deleteJson('/api/reportes/999')->assertNotFound();
    }
}
