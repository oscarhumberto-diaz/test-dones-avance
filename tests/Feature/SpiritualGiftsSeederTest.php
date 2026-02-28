<?php

namespace Tests\Feature;

use App\Models\SpiritualTest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SpiritualGiftsSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_seed_creates_60_questions_20_gifts_and_3_questions_per_gift(): void
    {
        $this->seed();

        $test = SpiritualTest::query()->where('nombre', 'Test de Dones Espirituales (AVANCE 2020)')->first();

        $this->assertNotNull($test);
        $this->assertCount(60, $test->questions);
        $this->assertCount(20, $test->gifts);

        foreach ($test->gifts as $gift) {
            $this->assertCount(3, $gift->questions);
        }
    }
}
