<?php

namespace App\Http\Controllers;

use App\Models\TokenUsage;

class DashboardController extends Controller
{
    public function index()
    {
        $usages = TokenUsage::where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('dashboard', compact('usages'));
    }
}
