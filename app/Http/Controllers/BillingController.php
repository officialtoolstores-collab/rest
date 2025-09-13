<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillingController extends Controller
{
    // Форма поповнення (плейсхолдер, поки без інтеграції)
    public function create()
    {
        return view('billing.topup');
    }
}
