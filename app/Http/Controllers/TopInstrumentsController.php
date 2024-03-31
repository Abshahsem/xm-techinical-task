<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class TopInstrumentsController extends Controller
{
    private const DAILY_REDIS_KEY = 'top_daily_instruments';
    private const WEEKLY_REDIS_KEY = 'top_yearly_instruments';
    private const MONTHLY_REDIS_KEY = 'top_monthly_instruments';
    private const DAILY_TTL = 5 * 60;
    private const WEEKLY_TTL = 60 * 60;
    private const MONTHLY_TTL = 6 * 60 * 60;

    public function getDaily(): JsonResponse
    {
        $instruments = Redis::get(self::DAILY_REDIS_KEY);
        if (!$instruments) {
            $instruments = Instrument::withCount(['tweets' => function ($query) {
                $query->whereDate('created_at', Carbon::today());
            }])
                ->get()
                ->sortByDesc('tweets_count')
                ->take(10)
                ->pluck('tweets_count', 'name')
                ->toArray();
            Redis::set(self::DAILY_REDIS_KEY, json_encode($instruments), 'EX', self::DAILY_TTL);
        } else {
            $instruments = json_decode($instruments, true);
        }
        return response()->json($instruments);
    }

    public function getWeekly(): JsonResponse
    {
        $instruments = Redis::get(self::WEEKLY_REDIS_KEY);
        if (!$instruments) {
            $instruments = Instrument::withCount(['tweets' => function ($query) {
                $query->whereDate('created_at', Carbon::now()->subWeek());
            }])
                ->get()
                ->sortByDesc('tweets_count')
                ->take(10)
                ->pluck('tweets_count', 'name')
                ->toArray();
            Redis::set(self::WEEKLY_REDIS_KEY, json_encode($instruments), 'EX', self::WEEKLY_TTL);
        } else {
            $instruments = json_decode($instruments, true);
        }
        return response()->json($instruments);
    }

    public function getMonthly(): JsonResponse
    {
        $instruments = Redis::get(self::MONTHLY_REDIS_KEY);
        if (!$instruments) {
            $instruments = Instrument::withCount(['tweets' => function ($query) {
                $query->whereDate('created_at', '>=', Carbon::now()->subMonth());
            }])
                ->get()
                ->sortByDesc('tweets_count')
                ->pluck('tweets_count', 'name')
                ->toArray();
            Redis::set(self::MONTHLY_REDIS_KEY, json_encode($instruments), 'EX', self::MONTHLY_TTL);
        } else {
            $instruments = json_decode($instruments, true);
        }
        return response()->json($instruments);
    }
}
