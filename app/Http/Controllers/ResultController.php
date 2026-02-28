<?php

namespace App\Http\Controllers;

use App\Models\Attempt;
use Illuminate\View\View;

class ResultController extends Controller
{
    public function show(Attempt $attempt): View
    {
        $scores = $attempt->giftScores()->with('gift')->orderByDesc('final_score')->get();
        $topThree = $scores->take(3);

        return view('result', compact('attempt', 'scores', 'topThree'));
    }
}
