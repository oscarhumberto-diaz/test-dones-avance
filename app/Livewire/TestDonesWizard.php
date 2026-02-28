<?php

namespace App\Livewire;

use App\Models\Answer;
use App\Models\Attempt;
use App\Models\Gift;
use App\Models\GiftScore;
use App\Models\Question;
use App\Models\SpiritualTest;
use Database\Seeders\SpiritualGiftsSeeder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TestDonesWizard extends Component
{
    public string $nombre_persona = '';

    public int $pageIndex = 0;

    public int $testId;

    /** @var array<int, int|null> */
    public array $answers = [];

    /** @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\Question> */
    public Collection $questions;

    public function mount(): void
    {
        $test = SpiritualTest::query()->where('nombre', SpiritualGiftsSeeder::TEST_NAME)->firstOrFail();
        $this->testId = $test->id;

        $this->questions = Question::query()
            ->where('test_id', $this->testId)
            ->orderBy('numero')
            ->get();

        foreach ($this->questions as $question) {
            $this->answers[$question->id] = null;
        }
    }

    public function previousPage(): void
    {
        $this->pageIndex = max(0, $this->pageIndex - 1);
    }

    public function nextPage(): void
    {
        $this->validateCurrentPage();
        $this->pageIndex = min($this->lastPageIndex(), $this->pageIndex + 1);
    }

    public function submit(): mixed
    {
        $this->validateAll();

        $attempt = DB::transaction(function () {
            $attempt = Attempt::query()->create([
                'test_id' => $this->testId,
                'nombre_persona' => trim($this->nombre_persona),
            ]);

            foreach ($this->answers as $questionId => $valor) {
                Answer::query()->create([
                    'attempt_id' => $attempt->id,
                    'question_id' => $questionId,
                    'valor' => $valor,
                ]);
            }

            $scores = [];

            Gift::query()
                ->where('test_id', $this->testId)
                ->with('questions:id')
                ->get()
                ->each(function (Gift $gift) use ($attempt, &$scores) {
                    $suma = $gift->questions->sum(fn ($question) => (int) ($this->answers[$question->id] ?? 0));

                    $scores[] = [
                        'attempt_id' => $attempt->id,
                        'gift_id' => $gift->id,
                        'suma' => $suma,
                        'total' => $suma * 3,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                });

            GiftScore::query()->insert($scores);

            return $attempt;
        });

        return $this->redirectRoute('result.show', ['attempt' => $attempt->id], navigate: true);
    }

    public function render()
    {
        return view('livewire.test-dones-wizard', [
            'questionsForPage' => $this->questions->slice($this->pageIndex * 10, 10)->values(),
            'currentPage' => $this->pageIndex + 1,
            'totalPages' => $this->lastPageIndex() + 1,
        ]);
    }

    private function validateCurrentPage(): void
    {
        $rules = ['nombre_persona' => ['required', 'string', 'min:3', 'max:120']];

        foreach ($this->questionIdsForCurrentPage() as $questionId) {
            $rules["answers.$questionId"] = ['required', 'integer', 'between:0,3'];
        }

        $this->validate($rules);
    }

    private function validateAll(): void
    {
        $rules = ['nombre_persona' => ['required', 'string', 'min:3', 'max:120']];

        foreach ($this->questions as $question) {
            $rules["answers.$question->id"] = ['required', 'integer', 'between:0,3'];
        }

        $this->validate($rules);
    }

    /** @return array<int, int> */
    private function questionIdsForCurrentPage(): array
    {
        return $this->questions
            ->slice($this->pageIndex * 10, 10)
            ->pluck('id')
            ->all();
    }

    private function lastPageIndex(): int
    {
        return (int) ceil($this->questions->count() / 10) - 1;
    }
}
