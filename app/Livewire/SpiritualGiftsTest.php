<?php

namespace App\Livewire;

use App\Models\Answer;
use App\Models\Attempt;
use App\Models\Gift;
use App\Models\GiftScore;
use App\Models\Question;
use App\Models\SpiritualTest;
use Database\Seeders\SpiritualGiftsSeeder;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class SpiritualGiftsTest extends Component
{
    public string $full_name = '';

    public int $currentPage = 1;

    public int $perPage = 10;

    public int $testId;

    /** @var array<int, int|null> */
    public array $answers = [];

    public function mount(): void
    {
        $test = SpiritualTest::query()->where('nombre', SpiritualGiftsSeeder::TEST_NAME)->firstOrFail();
        $this->testId = $test->id;

        $questionIds = Question::query()
            ->where('test_id', $this->testId)
            ->orderBy('numero')
            ->pluck('id')
            ->all();

        foreach ($questionIds as $questionId) {
            $this->answers[$questionId] = null;
        }
    }

    public function prevPage(): void
    {
        $this->currentPage = max(1, $this->currentPage - 1);
    }

    public function nextPage(): void
    {
        $this->validateCurrentPage();
        $this->currentPage = min($this->totalPages(), $this->currentPage + 1);
    }

    public function submit(): mixed
    {
        $this->validateAll();

        $attempt = DB::transaction(function () {
            $attempt = Attempt::query()->create([
                'test_id' => $this->testId,
                'nombre_persona' => trim($this->full_name),
            ]);

            foreach ($this->answers as $questionId => $value) {
                Answer::query()->create([
                    'attempt_id' => $attempt->id,
                    'question_id' => $questionId,
                    'valor' => $value,
                ]);
            }

            $scores = [];

            Gift::query()->where('test_id', $this->testId)->with('questions:id')->get()->each(function (Gift $gift) use ($attempt, &$scores) {
                $suma = $gift->questions->sum(fn ($question) => (int) ($this->answers[$question->id] ?? 0));
                $total = $suma * 3;

                $scores[] = [
                    'attempt_id' => $attempt->id,
                    'gift_id' => $gift->id,
                    'suma' => $suma,
                    'total' => $total,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            });

            GiftScore::query()->insert($scores);

            return $attempt;
        });

        session()->flash('success', '¡Test enviado con éxito! Ya puedes revisar tus resultados.');

        return $this->redirectRoute('result.show', $attempt->id, navigate: true);
    }

    public function render()
    {
        $questions = Question::query()->where('test_id', $this->testId)->orderBy('numero')->get();
        $slice = $questions->forPage($this->currentPage, $this->perPage);

        return view('livewire.spiritual-gifts-test', [
            'questions' => $slice,
            'totalQuestions' => $questions->count(),
            'totalPages' => $this->totalPages(),
        ]);
    }

    private function validateCurrentPage(): void
    {
        $this->validate($this->rulesForQuestionRange());
    }

    private function validateAll(): void
    {
        $rules = ['full_name' => ['required', 'string', 'min:5', 'max:120']];

        foreach (array_keys($this->answers) as $questionId) {
            $rules["answers.$questionId"] = ['required', 'integer', 'between:0,3'];
        }

        $messages = [
            'full_name.required' => 'Por favor ingresa tu nombre completo.',
            'full_name.min' => 'El nombre debe tener al menos 5 caracteres.',
        ];

        $this->validate($rules, $messages);
    }

    private function rulesForQuestionRange(): array
    {
        $rules = ['full_name' => ['required', 'string', 'min:5', 'max:120']];

        $ids = Question::query()
            ->where('test_id', $this->testId)
            ->orderBy('numero')
            ->forPage($this->currentPage, $this->perPage)
            ->pluck('id');

        foreach ($ids as $questionId) {
            $rules["answers.$questionId"] = ['required', 'integer', 'between:0,3'];
        }

        return $rules;
    }

    private function totalPages(): int
    {
        $count = Question::query()->where('test_id', $this->testId)->count();

        return (int) ceil($count / $this->perPage);
    }
}
