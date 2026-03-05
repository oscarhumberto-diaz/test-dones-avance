<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attempt;
use App\Models\Gift;
use App\Models\Test;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HistoryController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date'],
            'participant' => ['nullable', 'string', 'max:200'],
            'test_id' => ['nullable', 'integer', 'exists:tests,id'],
            'top_gift_id' => ['nullable', 'integer', 'exists:gifts,id'],
        ]);

        $tests = Test::orderBy('nombre')->get();
        $selectedTestId = $validated['test_id'] ?? Test::query()->where('nombre', 'like', '%AVANCE 2020%')->value('id');

        $attempts = Attempt::query()
            ->with(['giftScores.gift', 'test'])
            ->when($selectedTestId, fn (Builder $query) => $query->where('test_id', $selectedTestId))
            ->when($validated['from'] ?? null, fn (Builder $query, string $from) => $query->whereDate('created_at', '>=', $from))
            ->when($validated['to'] ?? null, fn (Builder $query, string $to) => $query->whereDate('created_at', '<=', $to))
            ->when($validated['participant'] ?? null, fn (Builder $query, string $participant) => $query->where('nombre_persona', 'like', "%{$participant}%"))
            ->when($validated['top_gift_id'] ?? null, function (Builder $query, int $giftId) {
                $query->whereExists(function ($subQuery) use ($giftId) {
                    $subQuery->selectRaw('1')
                        ->from('attempt_gift_scores as ags')
                        ->whereColumn('ags.attempt_id', 'attempts.id')
                        ->where('ags.gift_id', $giftId)
                        ->whereRaw('ags.total = (select max(ags2.total) from attempt_gift_scores ags2 where ags2.attempt_id = attempts.id)');
                });
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $attempts->getCollection()->transform(function (Attempt $attempt) {
            $ranked = $attempt->giftScores->sortByDesc('total')->values();
            $attempt->setRelation('giftScores', $ranked);
            return $attempt;
        });

        $gifts = Gift::query()
            ->when($selectedTestId, fn (Builder $query) => $query->where('test_id', $selectedTestId))
            ->orderBy('nombre')
            ->get();

        return view('admin.history.index', [
            'attempts' => $attempts,
            'tests' => $tests,
            'gifts' => $gifts,
            'selectedTestId' => $selectedTestId,
            'filters' => $validated,
        ]);
    }

    public function show(Attempt $attempt): View
    {
        $attempt->load(['giftScores.gift', 'test']);

        $scores = $attempt->giftScores->sortByDesc('total')->values();

        return view('admin.history.show', [
            'attempt' => $attempt,
            'scores' => $scores,
            'topThree' => $scores->take(3),
        ]);
    }
}
