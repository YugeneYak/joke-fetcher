<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function track(Request $request)
    {
        $validated = $request->validate([
            'ip'        => 'required|string|max:45',
            'city'      => 'required|string|max:255',
            'device'    => 'required|string|in:desktop,mobile,tablet',
            'page'      => 'required|string',
            'referrer'  => 'nullable|string',
            'timestamp' => 'required|date'
        ]);

        Visit::create([
            'ip'         => $validated['ip'],
            'city'       => $validated['city'],
            'device'     => $validated['device'],
            'page'       => $validated['page'],
            'referrer'   => $validated['referrer'],
            'visited_at' => $validated['timestamp']
        ]);

        return response()->json(['status' => 'ok']);
    }
}
