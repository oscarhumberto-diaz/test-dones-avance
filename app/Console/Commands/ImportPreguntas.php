<?php

namespace App\Console\Commands;

use App\Models\Question;
use App\Models\Test;
use Database\Seeders\SpiritualGiftsSeeder;
use Illuminate\Console\Command;

class ImportPreguntas extends Command
{
    protected $signature = 'avance:import-preguntas {path}';

    protected $description = 'Importa preguntas JSON para el test AVANCE 2020';

    public function handle(): int
    {
        $path = $this->argument('path');

        if (! is_file($path) || ! is_readable($path)) {
            $this->error("No se puede leer el archivo: {$path}");
            return self::FAILURE;
        }

        $decoded = json_decode((string) file_get_contents($path), true);
        if (! is_array($decoded)) {
            $this->error('JSON inválido. Debe ser un array de objetos con numero/texto.');
            return self::FAILURE;
        }

        $test = Test::query()->where('nombre', SpiritualGiftsSeeder::TEST_NAME)->first();
        if (! $test) {
            $this->error('No existe el test AVANCE 2020. Ejecuta migrate --seed primero.');
            return self::FAILURE;
        }

        $updated = 0;
        $ignored = 0;
        $errors = 0;

        foreach ($decoded as $row) {
            if (! is_array($row)) {
                $errors++;
                continue;
            }

            $numero = isset($row['numero']) ? (int) $row['numero'] : 0;
            $texto = trim((string) ($row['texto'] ?? ''));

            if ($numero < 1 || $numero > 60 || $texto === '') {
                $ignored++;
                continue;
            }

            $affected = Question::query()
                ->where('test_id', $test->id)
                ->where('numero', $numero)
                ->update(['texto' => $texto, 'updated_at' => now()]);

            $updated += $affected;
        }

        $this->info("Actualizadas {$updated} preguntas, ignoradas {$ignored}, errores {$errors}.");

        return self::SUCCESS;
    }
}
