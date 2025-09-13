<?php

namespace App\Http\Controllers;

use App\Models\TokenUsage;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $usages = $user->tokenUsages()
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('dashboard', compact('user', 'usages'));
    }
}
