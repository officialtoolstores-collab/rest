<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // 1) Баланс USDT з таблиці wallets (поліморфний гаманець користувача)
        $wallet = DB::table('wallets')
            ->where('walletable_type', User::class)
            ->where('walletable_id', $user->id)
            ->first();

        $balanceUsdt = $wallet?->balance ? (float)$wallet->balance : 0.0;

        // 2) Залишок токенів — обчислюємо від балансу USDT (за потреби заміни на реальний токен-баланс — підмінимо тут)
        $tokenPrice = (float) config('services.tokens.price_usdt', 0.01);
        $tokensLeft = $tokenPrice > 0 ? (int) floor($balanceUsdt / $tokenPrice) : 0;

        // 3) Серія для графіка за останні 30 днів
        $start = now()->subDays(29)->startOfDay();
        $labels = [];
        $byDay = [];
        for ($i = 0; $i < 30; $i++) {
            $d = $start->copy()->addDays($i)->toDateString(); // Y-m-d
            $labels[] = $d;
            $byDay[$d] = 0;
        }

        $usagesList = collect(); // для таблиці (останні 15 записів)

        if (Schema::hasTable('token_usages')) {
            // Власна таблиця використань токенів
            $rows = DB::table('token_usages')
                ->selectRaw('DATE(created_at) as d, SUM(tokens) as total')
                ->where('user_id', $user->id)
                ->where('created_at', '>=', $start)
                ->groupBy('d')
                ->orderBy('d')
                ->get();

            foreach ($rows as $r) {
                $key = Carbon::parse($r->d)->toDateString();
                if (isset($byDay[$key])) {
                    $byDay[$key] = (int)$r->total;
                }
            }

            $latest = DB::table('token_usages')
                ->where('user_id', $user->id)
                ->orderByDesc('created_at')
                ->limit(15)
                ->get();

            // Нормалізуємо під в’юшку
            $usagesList = $latest->map(function ($row) {
                return (object)[
                    'action'     => 'usage',
                    'tokens'     => (int)$row->tokens,
                    'created_at' => Carbon::parse($row->created_at),
                ];
            });

        } elseif (Schema::hasTable('wallet_transactions')) {
            // fallback: беремо негативні суми як витрати (у USDT), конвертуємо в токени
            $rows = DB::table('wallet_transactions')
                ->selectRaw('DATE(created_at) as d, SUM(CASE WHEN amount < 0 THEN ABS(amount) ELSE 0 END) as spent_usdt')
                ->where('wallet_id', $wallet->id ?? 0)
                ->where('created_at', '>=', $start)
                ->groupBy('d')
                ->orderBy('d')
                ->get();

            foreach ($rows as $r) {
                $key = Carbon::parse($r->d)->toDateString();
                if (isset($byDay[$key])) {
                    $byDay[$key] = $tokenPrice > 0 ? (int) round(((float)$r->spent_usdt) / $tokenPrice) : 0;
                }
            }

            $latest = DB::table('wallet_transactions')
                ->where('wallet_id', $wallet->id ?? 0)
                ->orderByDesc('created_at')
                ->limit(15)
                ->get();

            $usagesList = $latest->map(function ($row) use ($tokenPrice) {
                $spentUsdt = $row->amount < 0 ? abs((float)$row->amount) : 0.0;
                $tokens = $tokenPrice > 0 ? (int) round($spentUsdt / $tokenPrice) : 0;

                // спроба витягти дію з meta, якщо є
                $action = 'tx';
                if (property_exists($row, 'meta') && $row->meta) {
                    $meta = is_string($row->meta) ? json_decode($row->meta, true) : (array)$row->meta;
                    if (!empty($meta['action'])) {
                        $action = $meta['action'];
                    } elseif (!empty($meta['type'])) {
                        $action = $meta['type'];
                    }
                }

                return (object)[
                    'action'     => $action,
                    'tokens'     => $tokens,
                    'created_at' => Carbon::parse($row->created_at),
                ];
            });

        } else {
            // немає даних — залишимо серію з нулями
        }

        $chartLabels = $labels;
        $chartData   = array_values($byDay);

        // Пагінація таблиці (не обов’язково, але звично)
        $usages = collect($usagesList)->sortByDesc('created_at')->values();

        return view('dashboard', compact(
            'user',
            'balanceUsdt',
            'tokensLeft',
            'chartLabels',
            'chartData',
            'usages'
        ));
    }
}
