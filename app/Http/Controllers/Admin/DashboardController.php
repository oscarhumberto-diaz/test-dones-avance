<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attempt;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'attemptsCount' => Attempt::count(),
            'lastAttemptAt' => Attempt::latest()->value('created_at'),
        ]);
    }
}
