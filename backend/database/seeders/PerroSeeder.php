<?php

namespace Database\Seeders;

use App\Models\Perro;
use App\Models\Vacuna;
use Illuminate\Database\Seeder;

class PerroSeeder extends Seeder
{
    /**
     * Los 35 perros del refugio (ficticios). Los 10 primeros son los de docs/diseno/contenido.md. No se siembra a Lucero: es el perro que se registra en vivo en la demo.
     * Columnas: nombre, sexo, descripcion, edad_aprox, como_llego, vacunas, cuidados, llegó hace (días), estado.
     */
    private const PERROS = [
        ['Rocco', 'macho', 'Macho, pitbull café, 5 años', '5 años', 'herido', 'si', 'Bañarlo solo con el champú que dio el veterinario', 400, 'en_refugio'],
        ['Nube', 'hembra', 'Hembra, criolla blanca, 4 años', '4 años', 'bien', 'si', 'Comida blanda', 700, 'en_refugio'],
        ['Toby', 'macho', 'Macho, negro con pecho blanco, 6 años', '6 años', 'flaco', 'si', 'No se la lleva bien con otros machos. Póngalo con hembras.', 900, 'en_refugio'],
        ['Bruno', 'macho', 'Macho, criollo canela, unos 2 años', 'unos 2 años', 'flaco', 'no_se', 'Recién llegado: que lo revise el veterinario', 2, 'en_refugio'],
        ['Canela', 'hembra', 'Hembra, mestiza mona, 8 años', '8 años', 'enfermo', 'si', 'Gotas en el ojo izquierdo, mañana y noche', 1500, 'en_refugio'],
        ['Mona', 'hembra', 'Hembra, pequeña y peluda, 3 años', '3 años', 'bien', 'si', 'Muy cariñosa, ideal para una familia', 300, 'en_refugio'],
        ['Lucas', 'macho', 'Macho, cachorro manchado, 5 meses', '5 meses', 'bien', 'no', 'Juega brusco con los grandes', 60, 'en_refugio'],
        ['Princesa', 'hembra', 'Hembra, french poodle gris, 10 años', '10 años', 'bien', 'si', 'Casi no ve: no le cambie las cosas de lugar', 2000, 'en_refugio'],
        ['Pirata', 'macho', 'Macho, tuerto, labrador cruzado, 7 años', '7 años', 'herido', 'si', 'Cojea de la pata de atrás: que no suba escaleras', 1100, 'en_refugio'],
        ['Chispa', 'hembra', 'Hembra, cachorra negra, 4 meses', '4 meses', 'bien', 'no', null, 45, 'adoptado'],
        ['Lola', 'hembra', 'Hembra, criolla café clara, 3 años', '3 años', 'flaco', 'si', null, 520, 'en_refugio'],
        ['Max', 'macho', 'Macho, pastor alemán cruzado, 7 años', '7 años', 'bien', 'si', 'Come mucho: dele su porción aparte', 1300, 'en_refugio'],
        ['Negrita', 'hembra', 'Hembra, criolla negra, 5 años', '5 años', 'herido', 'si', null, 800, 'en_refugio'],
        ['Pelusa', 'hembra', 'Hembra, pequeña blanca y peluda, 2 años', '2 años', 'bien', 'si', 'Cepillarla los sábados', 240, 'en_refugio'],
        ['Coco', 'macho', 'Macho, criollo café oscuro, 4 años', '4 años', 'flaco', 'si', null, 610, 'en_refugio'],
        ['Manchas', 'macho', 'Macho, blanco con manchas negras, 3 años', '3 años', 'bien', 'si', null, 430, 'en_refugio'],
        ['Duque', 'macho', 'Macho, criollo amarillo, 9 años', '9 años', 'enfermo', 'si', 'Es mayor: comida blanda', 1700, 'en_refugio'],
        ['Kira', 'hembra', 'Hembra, husky cruzada, 4 años', '4 años', 'bien', 'si', 'Se sale por debajo de la reja', 350, 'en_refugio'],
        ['Sasha', 'hembra', 'Hembra, mestiza gris, 6 años', '6 años', 'flaco', 'si', null, 980, 'en_refugio'],
        ['Rufo', 'macho', 'Macho, criollo peludo café, 8 años', '8 años', 'herido', 'si', 'Le duelen las caderas: que no salte', 1450, 'en_refugio'],
        ['Paco', 'macho', 'Macho, pequeño y blanco, 5 años', '5 años', 'bien', 'si', null, 700, 'en_refugio'],
        ['Luna', 'hembra', 'Hembra, criolla blanca con negro, 2 años', '2 años', 'flaco', 'si', null, 180, 'en_refugio'],
        ['Dulce', 'hembra', 'Hembra, beagle cruzada, 7 años', '7 años', 'bien', 'si', null, 1200, 'en_refugio'],
        ['Zeus', 'macho', 'Macho, rottweiler cruzado, 5 años', '5 años', 'bien', 'si', 'Bravo con extraños: preséntelo despacio', 900, 'en_refugio'],
        ['Bombón', 'hembra', 'Hembra, cachorra café, 6 meses', '6 meses', 'flaco', 'no', null, 90, 'en_refugio'],
        ['Lupe', 'hembra', 'Hembra, criolla atigrada, 4 años', '4 años', 'herido', 'si', null, 560, 'en_refugio'],
        ['Rambo', 'macho', 'Macho, criollo negro grande, 6 años', '6 años', 'herido', 'si', null, 1000, 'en_refugio'],
        ['Muñeca', 'hembra', 'Hembra, shih tzu cruzada, 9 años', '9 años', 'bien', 'si', 'Comida blanda: le faltan dientes', 1600, 'en_refugio'],
        ['Pepe', 'macho', 'Macho, cachorro negro y café, 4 meses', '4 meses', 'enfermo', 'no', null, 25, 'en_refugio'],
        ['Tita', 'hembra', 'Hembra, pequeña café, 11 años', '11 años', 'bien', 'si', 'Es mayor: que duerma bajo techo', 2100, 'en_refugio'],
        ['Simón', 'macho', 'Macho, criollo canela claro, 3 años', '3 años', 'flaco', 'si', null, 400, 'en_refugio'],
        ['Greta', 'hembra', 'Hembra, pastora cruzada, 5 años', '5 años', 'bien', 'si', null, 760, 'en_refugio'],
        ['Oso', 'macho', 'Macho, grande y peludo negro, 4 años', '4 años', 'bien', 'si', 'Le da calor: déjelo a la sombra', 650, 'en_refugio'],
        ['Chocolate', 'macho', 'Macho, labrador café cruzado, 6 años', '6 años', 'enfermo', 'si', null, 1150, 'en_refugio'],
        ['Frida', 'hembra', 'Hembra, criolla blanca con café, 1 año', '1 año', 'flaco', 'no', null, 120, 'en_refugio'],
    ];

    public function run(): void
    {
        foreach (self::PERROS as $i => [$nombre, $sexo, $descripcion, $edad, $comoLlego, $vacunas, $cuidados, $haceDias, $estado]) {
            $perro = Perro::create([
                'nombre' => $nombre,
                'sexo' => $sexo,
                'descripcion' => $descripcion,
                'edad_aprox' => $edad,
                'como_llego' => $comoLlego,
                'vacunas' => $vacunas,
                'cuidados' => $cuidados,
                'llego_el' => today()->subDays($haceDias),
                'estado' => $estado,
            ]);

            $this->vacunar($perro, $i);
        }
    }

    // si = las tres aplicadas en el último año · no = las tres faltan · no_se = sin registro (Bruno).
    private function vacunar(Perro $perro, int $i): void
    {
        if ($perro->vacunas === 'no_se') {
            return;
        }

        foreach (Vacuna::NOMBRES as $nombre) {
            $aplicada = $perro->vacunas === 'si' ? today()->subDays(30 + ($i * 37) % 300) : null;

            // Nube: rabia en abril (hace 6 meses) y le falta el moquillo, como en la ficha de contenido.md.
            if ($perro->nombre === 'Nube') {
                $aplicada = $nombre === 'moquillo' ? null : today()->subMonths(6);
            }

            $perro->registroVacunas()->create(['nombre' => $nombre, 'aplicada_el' => $aplicada]);
        }
    }
}
