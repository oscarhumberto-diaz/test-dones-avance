<?php

namespace Database\Seeders;

use App\Models\Gift;
use App\Models\Question;
use App\Models\SpiritualTest;
use Illuminate\Database\Seeder;

class SpiritualGiftsSeeder extends Seeder
{
    public const TEST_NAME = 'Test de Dones Espirituales (AVANCE 2020)';

    public function run(): void
    {
        $test = SpiritualTest::query()->updateOrCreate(
            ['nombre' => self::TEST_NAME],
            [
                'instrucciones' => 'Marca cada afirmación según tu frecuencia: 0=Nunca, 1=Rara vez, 2=Frecuentemente, 3=Siempre.',
                'escala_min' => 0,
                'escala_max' => 3,
            ]
        );

        for ($numero = 1; $numero <= 60; $numero++) {
            Question::query()->updateOrCreate(
                ['test_id' => $test->id, 'numero' => $numero],
                ['texto' => "Pregunta {$numero}"]
            );
        }

        $giftMap = [
            'Administración' => [1, 21, 41],
            'Artístico' => [2, 22, 42],
            'Exhortación' => [3, 23, 43],
            'Discernimiento' => [4, 24, 44],
            'Evangelismo' => [5, 25, 45],
            'Fe' => [6, 26, 46],
            'Dar' => [7, 27, 47],
            'Misericordia' => [8, 28, 48],
            'Ayuda' => [9, 29, 49],
            'Hospitalidad' => [10, 30, 50],
            'Intercesión' => [11, 31, 51],
            'Conocimiento' => [12, 32, 52],
            'Liderazgo' => [13, 33, 53],
            'Pastor' => [14, 34, 54],
            'Enseñanza' => [15, 35, 55],
            'Sabiduría' => [16, 36, 56],
            'Profecía' => [17, 37, 57],
            'Misionero' => [18, 38, 58],
            'Lenguas' => [19, 39, 59],
            'Interpretación' => [20, 40, 60],
        ];

        foreach ($giftMap as $nombre => $numeros) {
            $gift = Gift::query()->updateOrCreate(
                ['test_id' => $test->id, 'nombre' => $nombre],
                ['test_id' => $test->id, 'nombre' => $nombre]
            );

            $questionIds = Question::query()
                ->where('test_id', $test->id)
                ->whereIn('numero', $numeros)
                ->orderBy('numero')
                ->pluck('id')
                ->all();

            $gift->questions()->sync($questionIds);
        }
    }
}
