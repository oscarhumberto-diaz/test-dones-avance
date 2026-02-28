<?php

namespace App\Console\Commands;

use App\Models\Question;
use App\Models\SpiritualTest;
use Database\Seeders\SpiritualGiftsSeeder;
use Illuminate\Console\Command;

class ImportAvancePreguntas extends Command
{
    protected $signature = 'avance:import-preguntas {path}';

    protected $description = 'Importa preguntas (CSV o JSON) y actualiza texto por numero para el test AVANCE 2020';

    public function handle(): int
    {
        $path = $this->argument('path');

        if (! is_file($path) || ! is_readable($path)) {
            $this->error("No se puede leer el archivo: {$path}");

            return self::FAILURE;
        }

        $test = SpiritualTest::query()->where('nombre', SpiritualGiftsSeeder::TEST_NAME)->first();

        if (! $test) {
            $this->error('No existe el test AVANCE 2020. Ejecuta primero el seeder.');

            return self::FAILURE;
        }

        $rows = $this->rowsFromFile($path);
        $updated = 0;

        foreach ($rows as $row) {
            $numero = isset($row['numero']) ? (int) $row['numero'] : null;
            $texto = isset($row['texto']) ? trim((string) $row['texto']) : null;

            if (! $numero || $texto === '') {
                continue;
            }

            $affected = Question::query()
                ->where('test_id', $test->id)
                ->where('numero', $numero)
                ->update(['texto' => $texto, 'updated_at' => now()]);

            $updated += $affected;
        }

        $this->info("Preguntas actualizadas: {$updated}");

        return self::SUCCESS;
    }

    /**
     * @return array<int, array{numero:mixed, texto:mixed}>
     */
    private function rowsFromFile(string $path): array
    {
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        return match ($extension) {
            'json' => $this->rowsFromJson($path),
            'csv' => $this->rowsFromCsv($path),
            default => [],
        };
    }

    /**
     * @return array<int, array{numero:mixed, texto:mixed}>
     */
    private function rowsFromJson(string $path): array
    {
        $decoded = json_decode((string) file_get_contents($path), true);

        if (! is_array($decoded)) {
            return [];
        }

        return array_values(array_filter($decoded, fn ($item) => is_array($item)));
    }

    /**
     * @return array<int, array{numero:mixed, texto:mixed}>
     */
    private function rowsFromCsv(string $path): array
    {
        $handle = fopen($path, 'r');

        if ($handle === false) {
            return [];
        }

        $headers = fgetcsv($handle) ?: [];
        $rows = [];

        while (($line = fgetcsv($handle)) !== false) {
            if (count($line) !== count($headers)) {
                continue;
            }

            $row = array_combine($headers, $line);

            if (! is_array($row)) {
                continue;
            }

            $rows[] = [
                'numero' => $row['numero'] ?? null,
                'texto' => $row['texto'] ?? null,
            ];
        }

        fclose($handle);

        return $rows;
    }
}
