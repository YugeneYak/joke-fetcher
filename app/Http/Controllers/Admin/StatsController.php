<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $hourlyStats = Visit::select(
            DB::raw('strftime("%Y-%m-%d %H:00:00", visited_at) as hour'),
            DB::raw('COUNT(DISTINCT ip) as unique_visitors')
        )
            ->where('visited_at', '>=', now()->subHours(24))
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        $cityStats = Visit::select('city', DB::raw('COUNT(*) as total'))
            ->groupBy('city')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('stats', compact('hourlyStats', 'cityStats'));
    }
}
