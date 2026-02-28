<?php

namespace Tests\Feature;

use App\Livewire\TestDonesWizard;
use App\Models\Attempt;
use App\Models\AttemptGiftScore;
use App\Models\Gift;
use App\Models\Test as SpiritualTest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TestDonesWizardTest extends TestCase
{
    use RefreshDatabase;

    public function test_test_page_loads_component_with_instructions(): void
    {
        $this->seed();

        $this->get('/test')
            ->assertOk()
            ->assertSee('Test de Dones Espirituales')
            ->assertSeeLivewire('test-dones-wizard');
    }

    public function test_submit_creates_attempt_answers_and_gift_scores_then_redirects(): void
    {
        $this->seed();

        $test = SpiritualTest::query()->firstOrFail();
        $questionIds = $test->questions()->orderBy('numero')->pluck('id')->all();

        $component = Livewire::test(TestDonesWizard::class)->set('nombre_persona', 'Juan Perez');

        foreach ($questionIds as $questionId) {
            $component->set("answers.$questionId", 2);
        }

        $component->call('submit')->assertRedirect();

        $attempt = Attempt::query()->first();

        $this->assertNotNull($attempt);
        $this->assertSame('Juan Perez', $attempt->nombre_persona);
        $this->assertSame(60, $attempt->answers()->count());
        $this->assertSame(20, $attempt->giftScores()->count());

        $firstGift = Gift::query()->where('test_id', $test->id)->with('questions:id')->firstOrFail();
        $score = AttemptGiftScore::query()->where('attempt_id', $attempt->id)->where('gift_id', $firstGift->id)->firstOrFail();

        $this->assertSame(6, $score->suma);
        $this->assertSame(18, $score->total);
    }
}
